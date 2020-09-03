@extends('layouts.admin')

@section('title', 'Permissions')

@section('content_header')
    <h1><a href="/{{ config('adminlte.dashboard_url') }}/permissions">Permissions</a> / {!! (isset($model)) ? 'Edit' : 'Create' !!}</h1>
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
            </div>
            <div class="col-6">
               <div class="form-group">
                  <label>Alias*</label>
                  {!! Form::text('alias',null, ['class' => 'form-control']) !!}
               </div>
            </div>
            <div class="col-6">
               <div class="form-group">
                  <label>Menu</label>
                  {!! Form::select('menu_id', $options, null, ['placeholder' => 'Pilih Menu','class' => 'form-control']) !!}
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
{!! $validator->selector('#model-form') !!}
@endsection