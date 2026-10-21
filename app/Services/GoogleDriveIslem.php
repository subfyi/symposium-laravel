<?php

namespace App\Services;

use Google_Service_Drive_DriveFile;
use Illuminate\Support\Facades\Storage;

class GoogleDriveIslem
{
  protected $service;
  protected $folder = "1y1OsekCEKD3xXVKFI2KZKojbzfbLVG45";

  public function __construct()
  {
    $this->service = Storage::disk('google')->getAdapter()->getService();
  }

  public function direct() {
    return $this->service;
  }

  public function izinver($id) {
    $permission = new \Google_Service_Drive_Permission();
    $permission->setRole('reader');
    $permission->setType('anyone');
    $permission->setAllowFileDiscovery(false);
    $permissions = $this->service->permissions->create($id, $permission);
  }

  public function klasor($name) {
    $folder = $this->service->files->listFiles([
      "q" => "parents in '$this->folder' and name = '$name'",
      "fields" => 'files(id)'
    ]);

    if(count($folder->files) == 0) {
      $fileMetadata = new Google_Service_Drive_DriveFile(array(
        'name' => $name,
        'parents' => array($this->folder),
        'mimeType' => 'application/vnd.google-apps.folder'
      ));

      $file = $this->service->files->create($fileMetadata, array('fields' => 'id'));
      return $file->id;
    }

    return $folder->files[0]->id;
  }

  public function dosya($folder_id, $filename) {
    $file = $this->service->files->listFiles([
      "q" => "parents in '$folder_id' and name = '$filename'",
      "fields" => 'files(id, mimeType, thumbnailLink, size)'
    ]);

    return $file->files[0];
  }
}
