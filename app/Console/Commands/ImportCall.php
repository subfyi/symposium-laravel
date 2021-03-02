<?php

namespace App\Console\Commands;

use App\Facades\FileProcessing;
use Error;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class ImportCall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $integrations = Integration::where('aktiv', 1)->get();

        $tarif_ids = [];

        foreach ($integrations as $integration) {
            $xml = new \SimpleXMLElement($integration->url, NULL, TRUE);

            foreach ($xml->Tarifes->Tarife as $tarife) {
                try {
                    $provider = $this->findProvider($tarife['provider']);
                    if (!$provider) {
                        throw new Error("Unable to find provider: " . $tarife["provider"]);
                    }

                    $type = $this->findType($tarife['type'], TRUE);
                    if (!$type) {
                        throw new Error("Unable to find product type of tarif: " . $tarife["type"]);
                    }

                    $pdf = isset($tarife['pdf']) ? FileProcessing::download($tarife['pdf']) : null;

                    $tarif = $this->findOrCreateTarife([
                        "aktiv" => 1,
                        "url" => Str::slug($tarife['name']),
                        "anbieter_id" => $provider->id,
                        "bezeichnung" => $tarife['name'],
                        "tarifeigenschaft_4" => $tarife['contract'],
                        "provision" => $tarife['provision'],
                        "tarifeigenschaft_1" => $tarife['connectionPrice'],
                        "tarifeigenschaft_2" => isset($tarife['specialPrice']) ? $tarife['specialPrice'] : $tarife['price'],
                        "tarifeigenschaft_3" => isset($tarife['specialPrice']) ? $tarife['price'] : NULL,
                        "tarifeigenschaft_5" => isset($tarife['specialPriceUntil']) ? $tarife['specialPriceUntil'] : NULL,
                        "product_type_id" => $type->id,
                        "tarifinformation_file_id" => $pdf ? $pdf->id : null
                    ], [
                        "category_id" => 57
                    ]);

                    $tarif_ids[] = $tarif->tarif_id;

                    if (isset($tarife->Properties)) {
                        $property_ids = [];

                        foreach ($tarife->Properties->Group as $group) {
                            $group_ = $this->findPropertyGroup($type, $group['name']);
                            if (!$group_) {
                                throw new Error("Unable to find property type group: " . $group['name']);
                            }

                            foreach ($group->Property as $property) {
                                $property_ = $this->findProperty($group_, $property['name']);
                                if (!$property_) {
                                    throw new Error("Unable to find property: " . $property['name']);
                                }

                                $property_id = $this->insertOrUpdateTarifProperty($tarif->tarif_id, $property_, $property['value'], isset($property->Value) ? $property->Value : NULL);
                                if ($property_id) {
                                    if (is_array($property_id)) {
                                        $property_ids = array_merge($property_id, $property_ids);
                                    } else {
                                        $property_ids[] = $property_id;
                                    }
                                }
                            }
                        }

                        TarifeProperty::where('tarif_id', $tarif->tarif_id)->whereNotIn('id', $property_ids)->delete();
                    }

                    // TODO: Bu tarife match edilecek mi kontrolu?
                } catch(Throwable $e) {
                    echo "Unable to import Tarife: " . $e->getMessage() . "\n";
                    //Log::error("Unable to import Tarife: " . $e->getMessage());
                }
            }
        }

        // TODO: bu acilacak
        //Tarife::whereNotIn('tarif_id', $tarif_ids)/*->where('dontTouchThis', 0)*/->update([ "aktiv" => 0 ]);
    }

    private function findOrCreateTarife($data, $newData) {
        $tarife = Tarife::where('anbieter_id', $data["anbieter_id"])
            ->where('bezeichnung', $data["bezeichnung"]);

        $updated = $tarife
                ->update($data);

        if (!$updated) {
            return Tarife::create(array_merge($data, $newData));
        } else {
            return $tarife->first();
        }
    }

    private function findProvider($name) {
        $anbiater = Anbieter::where('name', $name)->first();
        if (!$anbiater)
            return NULL;

        return $anbiater;
    }

    private function findType($name, $isTarif = 0) {
        return ProductType::where('name', $name)->where('is_tarife', $isTarif)->first();
    }

    private function findPropertyGroup($type, $name) {
        return PropertyGroup::where("product_type_id", $type->id)->where('name', $name)->first();
    }

    private function findProperty($group, $name) {
        return Property::where("group_id", $group->id)->where('name', $name)->first();
    }

    private function findOrCreatePropertyOption($property, $value) {
        $option = PropertyValue::where("property_id", $property->id)->where('value', $value)->first();
        if (!$option) {
            $option = PropertyValue::create([
                'property_id' => $property->id,
                'value' => $value
            ]);
        }
        return $option;
    }

    private function insertOrUpdateTarifProperty($tarif_id, $property, $value, $values) {
        $value_ = TarifeProperty::where('tarif_id', $tarif_id)->where('property_id', $property->id);

        switch ($property->type) {
            case 1:
                $value = strtolower($value);
                $is_yes = ($value == "true" || $value == "yes" || $value == "ja");
                $is_no = $value == "false" || $value == "no" || $value == "nein";

                if (($is_yes && $is_no) || (!$is_yes && !$is_no)) {
                    echo "Unable to extract boolean value: " . $value . "\n"  . $is_yes . "  "  .$is_no;
                    return NULL;
                }

                $update = [ "value_bool" => $is_yes ? 1 : 0 ];
            break;
            case 2:
                $update = [ "value_text" => $value ];
            break;
            case 3:
                $option = $this->findOrCreatePropertyOption($property, $value);
                $update = [ "value_option_id" => $option->id ];
            break;
            case 4:
                $ids = [];

                if ($values != NULL) {
                    foreach ($values as $value) {
                        $option = $this->findOrCreatePropertyOption($property, $value['value']);
                        $value__ = $value_->where('value_option_id', $option->id)->first();

                        if (!$value__) {
                            $ids[] = TarifeProperty::create([
                                "value_option_id" => $option->id,
                                "tarif_id" => $tarif_id,
                                "property_id" => $property->id
                            ])->id;
                        } else {
                            $ids[] = $value__->id;
                        }
                    }
                }

                return $ids;
            default:
                echo "Invalid property type: " . $property->type . "\n";
                return NULL;
        }

        if (!$value_->update($update)) {
            return TarifeProperty::create(array_merge($update, [
                "tarif_id" => $tarif_id,
                "property_id" => $property->id
            ]))->id;
        } else {
            return $value_->first()->id;
        }
    }
}
