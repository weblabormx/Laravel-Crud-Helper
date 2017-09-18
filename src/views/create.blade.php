@extends('layout')

@section('content')
	
	@component('comp.module-header', ['module' => $module, 'create' => true])
	@endcomponent

	@include('errors.partial-list')

	{!! Form::open(array('url' => $url)) !!}
		@include($views_directory.'.partial-form', ['submitButtonText' => trans('messages.create')])
	{!! Form::close() !!}

@stop

@section('footer')
	@addscripts($views_directory.'.scripts')
@stop