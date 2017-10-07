@extends('layout')

@section('content')
	
	@component('laravel-crud-helper::module-header')
	@endcomponent

	@include('laravel-crud-helper::index-table')

@stop