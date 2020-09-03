@extends('layouts.admin')

@section('title', 'User')

@section('content_header')
    <h1><a href="/{{ config('adminlte.dashboard_url') }}/users">Users</a> / {!! (isset($model)) ? 'Edit' : 'Create' !!}</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
	      	@if(isset($model))
			    {{ Form::model($model, ['id' => 'user-form']) }}
			@else
			    {{ Form::open(['id' => 'user-form']) }}
			@endif
	  		@include('widgets.error')
	  		<div class="row">
		  		<div class="col-6">
					<div class="form-group">
			    		<label>Username*</label>
			    		{!! Form::text('username',null, ['class' => 'form-control']) !!}
			  		</div>
		  		</div>
		  		<!-- <div class="col-6">
			  		<div class="form-group">
			    		<label>Email*</label>
			    		{!! Form::text('email',null, ['class' => 'form-control']) !!}
			  		</div>
		  		</div> -->
	  		</div>

	  		<div class="row">
		  		<!-- <div class="col-6">
			  		<div class="form-group">
			    		<label>Phone*</label>
			    		{!! Form::text('phone',null, ['class' => 'form-control']) !!}
			  		</div>
			  	</div> -->
		  		<div class="col-6">
			  		<div class="form-group">
			    		<label>Password* <small><i>{!! (isset($model)) ? '(kosongkan jika tidak diubah)' : '' !!}</i></small></label>
			    		<input type="password" class="form-control" name="password">
			  		</div>
			  	</div>
	  		</div>

	  		<div class="row">
		  		<div class="col-6">
			  		<div class="form-group">
			    		<label>Role*</label>
			  			{!! Form::select('role_id', $roles, null, ['placeholder' => 'Select Role','class' => 'custom-select']) !!}
			  		</div>
			  	</div>
			</div>
			<div class="row">
		  		<div class="col-6">
			  		<div class="form-group">
			    		<label>Active</label>
			    		<div class="form-check">
				    		{!! Form::checkbox('active', \App\Enum\Status::ACTIVE, 
				    		isset($model->active) && $model->active == \App\Enum\Status::ACTIVE ? true : false,  
				    		['class' => 'form-check-input']) !!}
				    	</div>
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