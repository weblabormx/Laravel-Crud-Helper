<div class="panel panel-default">
    <div class="panel-heading">
        @if(isset($title))
            {{$title}}
        @else
            {{trans('messages.description')}}
        @endif
    </div>
    <div class="panel-body">
        <div class="col-xs-6">
            <dl class="dl-horizontal">
                {!! $left !!}
            </dl>
        </div>
        <div class="col-xs-6">
            <dl class="dl-horizontal">
                <dt>{{trans("messages.module.general.created_at")}}</dt>
                <dd>{{$object->created_at}}</dd>
                <dt>{{trans("messages.module.general.created_by")}}</dt>
                <dd>
                    @if(is_object($object->creator_user))
                        {{$object->creator_user->person->name}}
                    @endif
                </dd>
                <dt>{{trans("messages.module.general.updated_at")}}</dt>
                <dd>{{$object->updated_at}}</dd>
                <dt>{{trans("messages.module.general.updated_by")}}</dt>
                <dd>
                    @if(is_object($object->updater_user))
                        {{$object->updater_user->person->name}}
                    @endif
                </dd>
                @if(isset($right))
                    {!! $right !!}
                @endif
            </dl>
        </div>
    </div>
</div>