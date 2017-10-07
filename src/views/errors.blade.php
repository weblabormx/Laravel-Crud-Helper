@if($errors->any())
    <div class="alert alert-danger">
        <p><b>{{trans('messages.errors_found')}}:</b></p>
        <ul style="margin-top:10px;">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif