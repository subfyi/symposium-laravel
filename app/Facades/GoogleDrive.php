<?php

namespace App\Facades;

use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Facade;

class GoogleDrive extends Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'App\\Services\\GoogleDriveIslem'; }
}
