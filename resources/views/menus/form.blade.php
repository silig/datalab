@extends('layouts.admin')

@section('title', 'Menus')
@section('css')
<link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
<link href="{{ asset('vendor/iconpicker/fontawesome-iconpicker.min.css')}}" rel="stylesheet">
@stop
@section('content_header')
    <h1><a href="/{{ config('adminlte.dashboard_url') }}/menus">Permissions</a> / {!! (isset($model)) ? 'Edit' : 'Create' !!}</h1>
@stop

@section('content')
   <div class="card">
      <div class="card-body">
         @if(isset($model))
             {{ Form::model($model, ['id' => 'model-form']) }}
         @else
             {{ Form::open(['id' => 'model-form']) }}
         @endif
         @include('widgets.error')
         <div class="row">
            <div class="col-6">
               <div class="form-group">
                  <label>Name*</label>
                  {!! Form::text('name',null, ['class' => 'form-control']) !!}
               </div>
               <div class="form-group">
                  <label>Url</label>
                  {!! Form::text('url',null, ['class' => 'form-control']) !!}
               </div>
               <div class="form-group">
                  <label>Parent Menu</label>
                  {!! Form::select('parent_id', $options, null, ['placeholder' => 'Select Menu','class' => 'form-control parent']) !!}
               </div>
            </div>
            <div class="col-6">
               <div class="form-group">
                  <label>Icon*</label>
                  {!! Form::text('icon',null, ['class' => 'form-control social-icon']) !!}
               </div>
               <div class="form-group">
                  <label>Order*</label>
                  {!! Form::text('order',null, ['class' => 'form-control']) !!}
               </div>
            </div>
         </div>
      </div>
      <div class="card-footer">
         @include('widgets.submit_button')
      </div>
      {!! Form::close() !!}
   </div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
<script src="{{ asset('vendor/iconpicker/fontawesome-iconpicker.js')}}"></script>
<script type="text/javascript">
    $('.social-icon').iconpicker();
</script>
{!! $validator->selector('#model-form') !!}
@endsection