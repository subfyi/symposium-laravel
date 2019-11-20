<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('bsText', 'components.form.text', ['name','isim', 'value'=>null, 'attributes'=>[] ]);
        Form::component('bsPassword', 'components.form.password', ['name','isim', 'value'=>null, 'attributes'=>[] ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
