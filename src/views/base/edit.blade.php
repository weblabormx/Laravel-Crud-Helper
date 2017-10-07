@extends('layout')

@section('content')
	
	@component('laravel-crud-helper::module-header', ['module' => $module, 'edit' => true, 'object' => $object])
		{!!$object->title!!}
	@endcomponent
	
	@include('errors.partial-list')

	{!! Form::model($object, array('method' => 'put', 'url' => $url)) !!}
	    @include($views_directory.'.partial-form', ['submitButtonText' => trans('messages.edit')])
	{!! Form::close() !!}

@stop