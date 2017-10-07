@extends('layout')

@section('content')
	
	@component('laravel-crud-helper::module-header', ['object' => $object, 'module' => $module])
	@endcomponent

	@include('laravel-crud-helper::index-table', ['object' => $object, 'module' => $module, 'views_directory' => $views_directory])

@stop