<?php

namespace Modules\PkgWidget\App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class WidgetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../../Views', 'PkgWidget');
        $this->loadTranslationsFrom(__DIR__.'/../../lang' , 'PkgWidget');
        $this->publishes([
            __DIR__.'/../../Views' => resource_path('Views/vendor/PkgWidget'),
        ], 'PkgWidget-Views');
        
        
    }

    public function register()
    {
        // Enregistrer d'autres services si nécessaire
    }
}