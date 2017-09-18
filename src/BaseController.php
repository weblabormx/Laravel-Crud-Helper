<?php

namespace WeblaborMX\LaravelCrudHelper;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class BaseController extends Controller
{

    public function load() {
        if(!isset($this->base))
            $this->base = 'admin';
        $this->views_directory = $this->base.'.'.$this->module;
        $this->url = $this->base.'/'.$this->module;
        $this->normal_request = 'Illuminate\Http\Request';
        if(!isset($this->object))
            $this->object = 'App\\'.ucfirst($this->module);
        if(!isset($this->request))
            $this->request = $this->normal_request;
    }

    public function index()
    {
        $request = app($this->normal_request);
        $object = $this->repository->index($request->all());
        $module = $this->module;
        $view = 'laravel-crud-helper::index';
        if(\View::exists($this->views_directory.'.index'))
            $view = $this->views_directory.'.index';
        return view($view, compact('object', 'module'));
    }

    public function create()
    {
        $request = app($this->normal_request);
        $array = $this->repository->create($request);
        $module = $this->module;
        $url = $this->url;
        $views_directory = $this->views_directory;
        $view = 'laravel-crud-helper::create';
        if(\View::exists($this->views_directory.'.create'))
            $view = $this->views_directory.'.create';
        return view($view, compact('module', 'url', 'views_directory', $array));
    }

    public function store()
    {
        $request = app($this->request);
        $this->repository->store($request->all());
        flash()->success(trans('messages.saved_successfull'));
        return redirect($this->url);
    }

    public function show(Model $object)
    {
        $views_directory = $this->views_directory;
        $module = $this->module;
        $view = 'laravel-crud-helper::show';
        if(\View::exists($this->views_directory.'.show'))
            $view = $this->views_directory.'.show';
        return view($view, compact('object', 'module'));
    }

    public function edit(Model $object)
    {
        $url = $this->url.'/'.$object->primary_url;
        $module = $this->module;
        $views_directory = $this->views_directory;
        $view = 'laravel-crud-helper::edit';
        if(\View::exists($this->views_directory.'.edit'))
            $view = $this->views_directory.'.edit';
        return view($view, compact('module', 'url', 'views_directory', 'object'));
    }

    public function update(Model $object)
    {
        $request = app($this->request);

        $this->repository->update($object, $request->all());
        flash()->success(trans('messages.edited_successfull'));
        return back();
    }

    public function destroy(Model $object)
    {
        $this->repository->destroy($object);
        flash()->success(trans('messages.removed_successfull'));
        return redirect($this->url);
    }

}
