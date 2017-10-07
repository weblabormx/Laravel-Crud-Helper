<?php

namespace WeblaborMX\LaravelCrudHelper;

use Illuminate\Support\ServiceProvider;

class CrudHelperProvider extends ServiceProvider
{
    use Services;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'laravel-crud-helper');
        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/laravel-crud-helper'),
        ]);
        $this->loadTranslationsFrom(__DIR__.'/lang', 'laravel-crud-helper');
        $this->addServices();
            
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
