@extends('layouts.app')
@section('title', 'Menus')
@section('content')
<section class="content-header">
   <h1><a href="{{ Navigation::adminUrl('/menus') }}">@yield('title')</a> &raquo; View</h1>
</section>
<section class="content">
   	<div class="box">
      	<div class="box-header with-border">
      		<div class="col-xs-6">
         		<h3 class="box-title">Group Detail</h3>
         	</div>
      	</div>
      	<div class="box-body">
   			<div class="col-xs-6">
   				<div class="form-group">
   		    		<label>Name</label>
   		    		<div class="form-group">{!! $model->name !!}</div>
   		  		</div>
               <div class="form-group">
                  <label>Url</label>
                  <div class="form-group">{!! $model->url !!}</div>
               </div>
               <div class="form-group">
                  <label>Parent Menu</label>
                  <div class="form-group">{!! ($model->parent) ? $model->parent->name : '' !!}</div>
               </div>
   		  	</div>
            <div class="col-xs-6">
               <div class="form-group">
                  <label>Icon</label>
                  <div class="form-group">{!! $model->icon !!}</div>
               </div>
               <div class="form-group">
                  <label>Order</label>
                  <div class="form-group">{!! $model->order !!}</div>
               </div>
            </div>
      	</div>
      	<div class="box-footer">
      		<div class="col-xs-12">
	      		<div class="btn-group pull-right">
				  	<button type="button" class="btn btn-warning" onclick="history.back();">
				  		<i class="fa fa-arrow-circle-left"></i> Back</button>
				</div>
	      	</div>
      	</div>
   	</div>
</section>
@endsection