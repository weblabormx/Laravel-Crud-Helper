@extends('layout')

@section('content')
	
	@component('laravel-crud-helper::module-header', ['module' => $module, 'create' => true])
	@endcomponent

	@include('errors.partial-list')

	{!! Form::open(array('url' => $url)) !!}
		@include($views_directory.'.partial-form', ['submitButtonText' => trans('messages.create')])
	{!! Form::close() !!}

@stop

@section('footer')
	@addscripts($views_directory.'.scripts')
@stop