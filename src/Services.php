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
            $snake = snake_case($model);
            $model = 'App\\'.$model;
            Route::bind($snake, function ($value) use ($model) {
                return $model::findOrFail($value);
            });
        }

    }

    public function getModels(){
        $path = app_path();
        $out = [];
        $results = scandir($path);
        foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;
            $filename = $path . '/' . $result;
            if (!is_dir($filename)) {
                $name = substr($filename,0,-4);
                $name = strstr($name, 'app');
                $name = str_replace('app/', '', $name);
                $out[] = $name;
            }
        }
        return $out;
    }

}
