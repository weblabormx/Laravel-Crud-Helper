@extends('layout')

@section('content')
	
	@component('laravel-crud-helper::module-header', ['module' => $module, 'object' => $object])
		{{$object->title}}
	@endcomponent

	@component('laravel-crud-helper::show-variables', ['object' => $object])
	    @slot('left')
	    	@foreach($object->fillable as $fill)
	    		@isset($object->$fill)
		    		<dt>{{trans("messages.module.".$module.".".$fill)}}</dt>
					<dd>{{$object->$fill}}</dd>
				@endisset
	    	@endforeach
	    @endslot
	@endcomponent

@stop