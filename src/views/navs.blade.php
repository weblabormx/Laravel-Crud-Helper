<!-- Nav tabs -->
@php $cont = 0; $more = ''; @endphp
<ul class="nav nav-tabs" role="tablist">
    @foreach($array as $key => $value)
        @if(isset($ifs) && isset($ifs[$key]) && !$ifs[$key]) @php continue; @endphp @endif
        @if($cont==0) @php $more = 'active'; @endphp @endif
        @php $module = preg_replace('/[0-9]+/', '', $key); @endphp
        <li role="presentation" class="{{$more}}"><a href="#{{$key}}" aria-controls="{{$key}}" role="tab" data-toggle="tab">{{trans("messages.module.".$key)}}</a></li>
        @php $cont++; $more = ''; @endphp
    @endforeach
</ul>

<!-- Tab panes -->
@php $cont = 0; $more = ''; @endphp
<div class="tab-content">
    @foreach($array as $key => $value)
        @if(isset($ifs) && isset($ifs[$key]) && !$ifs[$key]) @php continue; @endphp @endif
        @if($cont==0) @php $more = ' active'; @endphp @endif
        @php $module = preg_replace('/[0-9]+/', '', $key); @endphp
        <div role="tabpanel" class="tab-pane{{$more}}" id="{{$key}}">
            @if($key=='statistics')
                @include('admin.stats', ['stats' => $value])
            @elseif($key=='statistics_order')
                @include('admin.stats', ['stats' => $value, 'orders' => true])
            @else
                @include('admin.'.$module.'.partial-index', [$module.'s' => $value])
            @endif
        </div>
        @php $cont++; $more = ''; @endphp
    @endforeach
</div>