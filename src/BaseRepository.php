<?php

namespace WeblaborMX\LaravelCrudHelper;

trait BaseRepository
{   

    public function index($inputs) {
        return;
    }
    public function store($inputs) {
        return;
    }

    public function create($request) {
        return [];
    }

    public function update($object, $inputs) {
        return $object->update($inputs);
    }

    public function destroy($object) {
        $object->delete();
    }

}
