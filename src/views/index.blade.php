@extends('layout')

@section('content')
	
	@component('comp.module-header', ['object' => $object, 'module' => $module])
	@endcomponent

	@include('comp.index-table', ['object' => $object, 'module' => $module])

@stop