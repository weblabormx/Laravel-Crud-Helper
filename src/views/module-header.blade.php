@if(isset($slot) && strlen($slot)==0) @php unset($slot); @endphp @endif
<ol class="breadcrumb">
    <li><a href="{{url('admin')}}">Panel de Control</a></li>
    @if(!isset($slot) && isset($module) && !isset($create)) <!-- index -->
        <li class="active">{{trans("messages.module.".$module)}}</li> 
    @elseif(isset($edit) && isset($module)) <!-- edit -->
        <li><a href="{{url('admin/'.$module)}}">{{trans("messages.module.".$module)}}</a></li>
        <li><a href="{{url('admin/'.$module.'/'.$object->primary_url)}}">{!!$slot!!}</a></li>
        <li class="active">{{trans('messages.edit')}}</li>
    @elseif(isset($create) && isset($module)) <!-- create -->
        <li><a href="{{url('admin/'.$module)}}">{{trans("messages.module.".$module)}}</a></li>
        <li class="active">{{trans('messages.create')}}</li>
    @elseif(isset($module)) <!-- show -->
        <li><a href="{{url('admin/'.$module)}}">{{trans("messages.module.".$module)}}</a></li>
        <li class="active">{{$slot}}</li>
    @else
        <li class="active">{{$slot}}</li>
    @endif
</ol>

<div class="title">
    @if(isset($object) && count($object)>1)
        <div id="quantity">
            <i class="fa fa-pie-chart"></i>
            <p>{{trans('laravel-crud-helpers::helper.total')}}</p>
            <p id="number">{{count($object)}}</p>
        </div>
    @endif
    @if(!isset($slot) && isset($module) && !isset($create)) <!-- index -->
        <h1>{{trans("messages.module.".$module)}}</h1>
    @elseif(isset($edit) && isset($module)) <!-- edit -->
        <h1><small>{{trans("messages.module.".$module)}}</small> {{$slot}}</h1>
    @elseif(isset($create) && isset($module)) <!-- create -->
        <h1><small>{{trans("messages.module.".$module)}}</small> {{trans('messages.create')}}</h1>
    @elseif(isset($module)) <!-- show -->
        <h1><small>{{trans("messages.module.".$module)}}</small> {{$slot}}</h1>
    @else
        <h1>{{$slot}}</h1>
    @endif
</div>

    <div class="links">
        @if(!isset($slot) && isset($module) && !isset($create)) <!-- index -->
            @route('admin/'.$module.'/create')
                <a href="{{url('admin/'.$module.'/create')}}"><i class="fa-btn fa fa-plus"></i> {{trans('messages.add_new')}}</a>
            @endroute
        @elseif(isset($edit) && isset($module)) <!-- edit -->

        @elseif(isset($create) && isset($module)) <!-- create -->
        @elseif(isset($module)) <!-- show -->
            @route('admin/'.$module.'/'.$object->id.'/edit')
                <a href="{{url('admin/'.$module.'/'.$object->primary_url.'/edit')}}"><i class="fa-btn fa fa-pencil"></i> {{trans('messages.edit')}}</a>
            @endroute
        @endif
            
        @if(isset($links))
            {{$links}}
        @endif
    </div>
