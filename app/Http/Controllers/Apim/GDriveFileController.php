<?php

namespace App\Http\Controllers\Apim;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Dosyalar;
use Carbon\Carbon;
use App\Facades\GoogleDrive;
use Illuminate\Http\Request;
use \Google_Http_MediaFileUpload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GDriveFileController extends Controller
{
    public function thumblink($id) {
        $dosya = Dosyalar::where('id', $id)->first();

        if($dosya->g_klasorismi == NULL) {
            $dosya->g_klasorismi = GoogleDrive::klasor($dosya->f_klasorismi);

            Dosyalar::where('id', $dosya->id)
                        ->update([ "g_klasorismi" => $dosya->g_klasorismi ]);
        }

        if($dosya->g_dosyaismi == NULL) {
            $dosya->g_dosyaismi = GoogleDrive::dosya($dosya->g_klasorismi, $dosya->f_dosyaisimi)->id;

            Dosyalar::where('id', $dosya->id)
                        ->update([ "g_dosyaismi" => $dosya->g_dosyaismi ]);
        }

        return GoogleDrive::dosya($dosya->g_klasorismi, $dosya->f_dosyaisimi)->thumbnailLink;
    }

    public function download($id) {
        $dosya = Dosyalar::where('id', $id)->first();

        if($dosya->g_klasorismi == NULL) {
            $dosya->g_klasorismi = GoogleDrive::klasor($dosya->f_klasorismi);

            Dosyalar::where('id', $dosya->id)
                        ->update([ "g_klasorismi" => $dosya->g_klasorismi ]);
        }

        if($dosya->g_dosyaismi == NULL) {
            $dosya->g_dosyaismi = GoogleDrive::dosya($dosya->g_klasorismi, $dosya->f_dosyaisimi)->id;

            Dosyalar::where('id', $dosya->id)
                        ->update([ "g_dosyaismi" => $dosya->g_dosyaismi ]);
        }

        $rawData = Storage::cloud()->get($dosya->g_dosyaismi);
        $escape = rawurlencode($dosya->r_dosyaisimi);

        return response($rawData, 200)
            ->header('ContentType', $dosya->f_dosya_uzanti)
            ->header('Content-Disposition', "attachment; filename*=UTF-8''$escape");
    }

    public function uploadbitti(Request $request) {
        $file = GoogleDrive::dosya($request->folder_id, $request->filename);

        $dosya = Dosyalar::create([
            "f_icerik_olusturan" => Auth::id(),
            "f_dosyayeri" => 2,
            "r_dosyaisimi" => $request->realfilename,
            "f_dosyaisimi" => $request->filename,
            "g_dosyaismi" => $file->id,
            "f_klasorismi" => $request->slug,
            "g_klasorismi" => $request->folder_id,
            "f_dosya_uzanti" => pathinfo($request->filename, PATHINFO_EXTENSION),
            "f_dosya_boyut" => $file->size,
            "width" => $request->width,
            "height" => $request->height,
            'f_sira' => $request->sira
        ]);

        GoogleDrive::izinver($file->id);

        return [
            "id" => $dosya->id,
            "name" => $request->realfilename,
            "size" => $file->size,
            "access_url" => "/gfile/".$dosya->id."/download",
            "g_dosyaismi" => $file->id
        ];
    }

    public function create(Request $request)
    {
        $client = GoogleDrive::direct()->getClient();

        $folder_id = GoogleDrive::klasor($request->slug);

        $tarih =  Str::slug(Carbon::now('Europe/Istanbul'));
        $realfilename = Str::slug($tarih."-". rand(100, 999) ."-". pathinfo($request->filename, PATHINFO_FILENAME)) . '.' .pathinfo($request->filename, PATHINFO_EXTENSION);

        $file = new \Google_Service_Drive_DriveFile();
        $file->name = $realfilename;
        $file->setParents([$folder_id]);

        $client->setDefer(true);
        $createdFile = GoogleDrive::direct()->files->create($file);

        $media = new Google_Http_MediaFileUpload(
            $client,
            $createdFile->withHeader('Origin', $_SERVER['HTTP_ORIGIN']),
            $request->contentType,
            null,
            true
        );

        $upload_url = $media->getResumeUri();

        return [
            "filename" => $realfilename,
            "folder_id" => $folder_id,
            "upload_link" => $upload_url
        ];
    }
}
