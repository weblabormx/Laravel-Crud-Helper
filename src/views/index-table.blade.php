@if(count($object) > 0)
	@if(!isset($extra)) @php $extra = [] @endphp @endif
	<div class="table-responsive">
		@include('admin.'.$module.'.partial-index', ['objects' => $object, 'extra' => $extra])
		{{$object->links()}}
	</div>
@else
	<div class="no-content">
		Sin resultados para mostrar
	</div>
@endif