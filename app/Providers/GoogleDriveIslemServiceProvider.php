<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GoogleDriveIslem;

class GoogleDriveIslemServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton(GoogleDriveIslem::class, function ($app) {
        return new GoogleDriveIslem();
      });
    }
}
