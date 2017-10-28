<div class="col-md-3">
    @if($type=='success')
        <div class="number verde">
            <i class="fa-check fa"></i>
    @elseif($type=='warning')
        <div class="number amarillo">
            <i class="fa-exclamation-triangle fa"></i>
    @else
        <div class="number rojo">
            <i class="fa-close fa"></i>
    @endif
        <h3>{{$slot}}</h3>
        <span>{{$total}}</span>
        @if(isset($link))
            <a href="{{$link}}"></a>
        @endif
    </div>
</div>