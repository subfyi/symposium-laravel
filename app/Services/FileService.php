<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\Files;
use Error;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FileService
{
    public function download($url)
    {
        $file = Files::where('url', $url)->first();

        $request = Http::withHeaders($file && $file->last_modified ? [
            "If-Modified-Since" => $file->last_modified
        ] : [])->get($url);

        if ($file && $request->status() == 304)
        {
            return $file;
        }

        if (!$request->ok())
        {
            throw new Error("Unable to download: " . $url);
        }

        $name = basename($url);
        $resim_uzanti = pathinfo($name, PATHINFO_EXTENSION);
        $resim_type = $request->header('Content-Type');

        $id = (string) Str::uuid();

        Storage::disk('uploads')->makeDirectory($id);
        Storage::disk('uploads')->put($id."/".$name, $request->toPsrResponse()->getBody());

        $resim_boyutu = Storage::disk('uploads')->size($id."/".$name);

        $width = null;
        $height = null;

        if (strpos($resim_type, "image/") === 0) {
            $img = @Image::make(Storage::disk('uploads')->readStream($id."/".$name));
            if ($img) {
                $width = $img->width();
                $height = $img->height();
            }
        }

        $dosya = Files::create([
            "f_icerik_olusturan" => 1,
            "f_dosyayeri"        => 1,
            "r_dosyaisimi"       => $name,
            "f_dosyaisimi"       => $name,
            "f_klasorismi"       => $id,
            "f_dosya_uzanti"     => $resim_uzanti,
            "f_dosya_boyut"      => $resim_boyutu,
            "width"              => $width,
            "height"             => $height,
            "content_type"       => $resim_type,
            "parent_id"          => $file ? $file->id : NULL,
            "last_modified"      => $request->header('Last-Modified'),
            "url"                => $url
        ]);

        return $dosya;
    }
}
