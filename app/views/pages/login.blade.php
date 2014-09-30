@extends('layouts.default')
@section('content')
    <div class="col-md-8 col-md-offset-2">

        <!-- PAGE TITLE =============================================== -->
        <div class="page-header">
            <h2>DD Snacks</h2>
        </div>

        {{ Form::open(array('url' => 'login', 'role' => 'form')) }}

            <!-- if there are login errors, show them here -->
            <p>
                {{ $errors->first('email') }}
                {{ $errors->first('password') }}
            </p>

            <div class="form-group">
                {{ Form::label('email', 'Email Address', array('class' => 'control-label')) }}
                {{ Form::text('email', Input::old('email'), array('placeholder' => 'you@doubledutch.me', 'class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Password', array('class' => 'control-label')) }}
                {{ Form::password('password', array('class' => 'form-control')) }}
            </div>

            <p>{{ Form::submit('Get snacking!', array('class' => 'btn btn-default')) }}</p>
        {{ Form::close() }}

    <p>Or <a href="/signup">create an account</a></p>

    <div class="footer"><a href="mailto:jordan@doubledutch.me?Subject=DD%20Snacks%20feedback">Send feedback</a></div>
    </div>


@stop

