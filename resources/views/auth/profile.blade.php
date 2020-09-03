@extends('layouts.admin')

@section('title', 'User Profile')

@section('content_header')
    <h1>User Profile</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<div class="callout callout-info">
						<h5>name</h5>
						<p>{{$profile->name}}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="callout callout-info">
						<h5>email</h5>
						<p>{{$profile->email}}</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="callout callout-info">
						<h5>phone</h5>
						<p>{{$profile->phone}}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="callout callout-info">
						<h5>role</h5>
						<p>{{$profile->role->name}}</p>
					</div>
				</div>
			</div>
	    </div>
	</div>
@stop

@section('js')

@endsection