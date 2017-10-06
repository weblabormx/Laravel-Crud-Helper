<?php

namespace WeblaborMX\LaravelCrudHelper;

use Illuminate\Support\Facades\Blade;
use Route;
use Illuminate\Http\Request;

trait Services
{

    private function addServices()
    {
        Blade::if('route', function ($url) {
            $routes = Route::getRoutes();
            $request = Request::create($url);
            try {
                $return = $routes->match($request);
                return true;
            } catch (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e){
                return false;
            }
            return false;
        });

        Blade::directive('addscripts', function ($view) {
            if(\View::exists($view))
                return "{{@include($view)}}";
            return "";
        });

        // Add all binds of all models on the folder
        foreach ($this->getModels() as $model) {
            $snake = snake_case($model['name']);
            Route::bind($snake, function ($value) use ($model) {
                return $model['model']::findOrFail($value);
            });
        }

    }

    public function getModels(){
        $files = \File::files('App');
        if(count($files)==0)
            $files = \File::allFiles('App\Models');
        return collect($files)->map(function($file) {
            return [
                'model' => str_replace('.php', '', $file->getPathname()),
                'name' => str_replace('.php', '', $file->getBasename())
            ];
        });
    }

}
