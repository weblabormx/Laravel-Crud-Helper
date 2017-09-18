<?php

namespace WeblaborMX\LaravelCrudHelper;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
