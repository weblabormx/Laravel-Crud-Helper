<?php

namespace WeblaborMX\LaravelCrudHelper;

use Illuminate\Database\Eloquent\Model;

trait BaseController
{

    public function load() {
        if(!isset($this->base))
            $this->base = 'admin';
        if(!isset($this->view_base))
            $this->view_base = $this->base;
        if(!isset($this->views_directory))
            $this->views_directory = $this->view_base.'.'.$this->module;
        $this->url = $this->base.'/'.$this->module;
        $this->normal_request = 'Illuminate\Http\Request';
        if(isset($this->request))
            $this->request_uri = 'App\Http\Requests\\'.$this->request;
        if(!isset($this->request_uri))
            $this->request_uri = $this->normal_request;
        $redirects = [
            'store' => $this->url,
            'update' => 'back',
            'destroy' => $this->url
        ];
        if(isset($this->redirects) && is_array($this->redirects))
            $redirects = array_merge($redirects, $this->redirects);
        $this->redirects = $redirects;
    }

    private function makeRedirection($url) {
        if($url=='back')
            return back();
        return redirect($url);
    }

    public function index()
    {
        $request = app($this->normal_request);
        $object = $this->repository->index($request->all());
        $module = $this->module;
        $views_directory = $this->views_directory;
        $view = 'laravel-crud-helper::base.index';
        if(\View::exists($this->views_directory.'.index'))
            $view = $this->views_directory.'.index';
        return view($view, compact('object', 'module', 'views_directory'));
    }

    public function create()
    {
        $request = app($this->normal_request);
        $array = $this->repository->create($request);
        $module = $this->module;
        $url = $this->url;
        $views_directory = $this->views_directory;
        $view = 'laravel-crud-helper::base.create';
        if(\View::exists($this->views_directory.'.create'))
            $view = $this->views_directory.'.create';
        return view($view, compact('module', 'url', 'views_directory', $array));
    }

    public function store()
    {
        $request = app($this->request_uri);
        $this->repository->store($request->all());
        flash()->success(trans('messages.saved_successfull'));
        return $this->makeRedirection($this->redirects['store']);
    }

    public function show(Model $object)
    {
        $views_directory = $this->views_directory;
        $module = $this->module;
        $view = 'laravel-crud-helper::base.show';
        if(\View::exists($this->views_directory.'.show'))
            $view = $this->views_directory.'.show';
        return view($view, compact('object', 'module'));
    }

    public function edit(Model $object)
    {
        $url = $this->url.'/'.$object->primary_url;
        $module = $this->module;
        $views_directory = $this->views_directory;
        $view = 'laravel-crud-helper::base.edit';
        if(\View::exists($this->views_directory.'.edit'))
            $view = $this->views_directory.'.edit';
        return view($view, compact('module', 'url', 'views_directory', 'object'));
    }

    public function update(Model $object)
    {
        $request = app($this->request_uri);

        $this->repository->update($object, $request->all());
        flash()->success(trans('messages.edited_successfull'));
        return $this->makeRedirection($this->redirects['update']);
    }

    public function destroy(Model $object)
    {
        $this->repository->destroy($object);
        flash()->success(trans('messages.removed_successfull'));
        return $this->makeRedirection($this->redirects['destroy']);
    }

}
