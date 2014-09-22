@extends('layouts.default')
@section('content')
    <div class="col-md-8 col-md-offset-2">

        <!-- PAGE TITLE =============================================== -->
        <div class="page-header">
            <h2>DD Snacks</h2>
        </div>

        {{ Form::open(array('url' => 'login', 'role' => 'form', 'class' => 'form-horizontal')) }}

            <!-- if there are login errors, show them here -->
            <div class="form-group">
                {{ $errors->first('email') }}
                {{ $errors->first('password') }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'Email Address') }}
                {{ Form::text('email', Input::old('email'), array('placeholder' => 'you@doubledutch.me')) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password') }}
            </div>

            <p>{{ Form::submit('Submit!', array('class' => 'btn btn-default')) }}</p>
        {{ Form::close() }}

    </div>
@stop

