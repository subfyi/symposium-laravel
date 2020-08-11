<?php

namespace App\Services;

use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DosyaService
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function mapKeys() {
        $keys = $this->request->all();

        foreach($keys as $key => $value) {
            if(isset($value["id"])) {
                if(isset($value["id"]) && (!isset($keys[$key . "_id"]) || $keys[$key . "_id"] != $value["id"])) {
                    $keys[$key . "_id"] = $value["id"];
                }
            } else if(is_array($value)) {
                if(!isset($keys[$key . "_ids"])) {
                    $keys[$key . "_ids"] = [];

                    foreach($value as $value2) {
                        if(isset($value2["id"])) {
                            array_push($keys[$key . "_ids"], $value2["id"]);
                        }
                    }
                }
            }
        }

        return $keys;
    }

    public function dosyaEslestir($key, $model, $dosyalar, callable $insert, callable $delete) {
        $varOlanDosyalar = $model->$key;

        foreach($dosyalar as $dosya_id) {
            foreach($varOlanDosyalar as $dosya) {
                if($dosya_id == $dosya["dosya_id"]) {
                    continue;
                }

                $insert($dosya_id);
            }
        }

        foreach($varOlanDosyalar as $dosya) {
            if(array_search($dosya["dosya_id"], $dosyalar) === false) {
                $delete($dosya["id"]);
            }
        }
    }
}
