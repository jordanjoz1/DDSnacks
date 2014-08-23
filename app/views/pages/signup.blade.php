@extends('layouts.default')
@section('content')
	{{ Form::open(array('url' => 'users/create')) }}

		<!-- if there are login errors, show them here -->
		<p>
			{{ $errors->first('email') }}
			{{ $errors->first('password') }}
			{{ $errors->first('password2') }}
		</p>

		<p>
			{{ Form::label('email', 'Email Address') }}
			{{ Form::text('email', Input::old('email'), array('placeholder' => 'awesome@doubledutch.me')) }}
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
@stop

