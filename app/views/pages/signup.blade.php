@extends('layouts.default')
@section('content')

    <div class="col-md-8 col-md-offset-2">

        <!-- PAGE TITLE =============================================== -->
        <div class="page-header">
            <h2>DD Snacks</h2>
        </div>

        {{ Form::open(array('url' => 'users/create', 'role' => 'form', 'class' => 'form-horizontal')) }}

            <!-- if there are login errors, show them here -->
            <p>
                {{ $errors->first('email') }}
            </p>

            <div class="form-group">
                {{ Form::label('email', 'Email Address', array('class' => 'control-label')) }}
                {{ Form::text('email', Input::old('email'), array('placeholder' => 'you@doubledutch.me', 'class' => 'form-control')) }}
            </div>

            <p>{{ Form::submit('Get snacking!', array('class' => 'btn btn-default')) }}</p>
        {{ Form::close() }}

        <p>Or <a href="/login">login</a></p>
    </div>
@stop

