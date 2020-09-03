@extends('layouts.admin')

@section('title', 'Roles')

@section('content_header')
    <h1><a href="/{{ config('adminlte.dashboard_url') }}/roles">Roles</a> / {!! (isset($model)) ? 'Edit' : 'Create' !!}</h1>
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
         </div>

         <div class="row">
            <div class="col-12">
               <div class="form-group">
                  <label>Setting Permission</label>
               </div>
            </div>
            <div class="col-12">
               <table class="table table-bordered table-striped">
                  <tr>
                     <th width="25%">Menu</th>
                     <th width="75%">Permission</th>
                  </tr>
                  @foreach($menus as $menu)
                     <tr>
                        <td>{!! $menu['label'] !!}</td>
                        <td>
                           <div class="row">
                              @foreach($menu['permissions'] as $permission)
                                 <div class="col-md-3">
                                    <label class="checkbox-inline">
                                       @php
                                       $checked = '';
                                       if (isset($model)) {
                                          foreach($model->permissions as $value) {
                                             if ($value->name == $permission['name']) {
                                                $checked = 'checked';
                                             }
                                          }
                                       }
                                       @endphp

                                       <input type="checkbox" {{ $checked }} name="permissions[]" value="{{ $permission['id'] }}">
                                       {{ $permission['alias'] }}
                                    </label>
                                 </div>
                              @endforeach
                           </div>
                        </td>
                     </tr>
                  @endforeach
               </table>
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