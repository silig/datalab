@extends('layouts.admin')

@section('title', 'Change Password')

@section('content_header')
    <h1>Change Password</h1>
@stop

@section('content')
	<div class="card">
		{{ Form::open(['id' => 'user-form']) }}
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
	      			@include('widgets.message')
	      			@include('widgets.error')
	      		</div>
      		</div>
      		<div class="row">
				<div class="col-md-4">
					<div class="form-group {{ $errors->has('now_password') ? 'has-error' : ''}}">
			    		<label>Old Password*</label>
			    		<input type="password" class="form-control" name="now_password">
			    		{!! $errors->first('now_password', '<span class="help-block error-help-block">:message</span>') !!}
			  		</div>
			  		<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
			    		<label>New Password*</label>
			    		<input type="password" class="form-control" name="password">
			    		{!! $errors->first('password', '<span class="help-block error-help-block">:message</span>') !!}
			  		</div>
			  		<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
			    		<label>Confirm Password*</label>
			    		<input type="password" class="form-control" name="password_confirmation">
			    		{!! $errors->first('password_confirmation', '<span class="help-block error-help-block">:message</span>') !!}
			  		</div>
			  	</div>
		  	</div>
	    </div>
	    <div class="card-footer">
	      	@include('widgets.submit_button')
      	</div>
      	{!! Form::close() !!}
	</div>
@stop

@section('js')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
{!! $validator->selector('#user-form') !!}
@endsection