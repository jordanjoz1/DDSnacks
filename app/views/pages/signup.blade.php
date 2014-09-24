@extends('layouts.default')
@section('content')

    <div class="col-md-8 col-md-offset-2">

        <!-- PAGE TITLE =============================================== -->
        <div class="page-header">
            <h2>DD Snacks</h2>
        </div>

        {{ Form::open(array('url' => 'users/create', 'class' => 'form-group')) }}

            <!-- if there are login errors, show them here -->
            <p>
                {{ $errors->first('email') }}
                {{ $errors->first('password') }}
                {{ $errors->first('password2') }}
            </p>

            <p>
                {{ Form::label('email', 'Email Address') }}
                {{ Form::text('email', Input::old('email'), array('placeholder' => 'you@doubledutch.me')) }}
            </p>

            <p>
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password') }}
            </p>
            <p>
                {{ Form::label('password2', 'Confirm password') }}
                {{ Form::password('password2') }}
            </p>

            <p>{{ Form::submit('Submit!') }}</p>
        {{ Form::close() }}

        <p>Or <a href="/login">login</a></p>
    </div>
@stop

