@extends('layouts.admin')

@section('title', 'Menus')

@section('content_header')
    <h1>Menus</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			@include('widgets.message')
			<div class="row">
			    <div class="col-12" style="margin-bottom: 20px;">
			    	@can('create-menus')
			    	<a class="btn btn-success btn-sm" href="menus/create"><i class="fa fa-plus"></i> Create</a>
			    	@endcan
			    </div>
			    <div class="col-12">
	               <table class="table table-bordered table-striped">
		                <tr>
		                    <th width="85%">Menu</th>
		                    <th width="15%" style="text-align: center;">Action</th>
		                </tr>
		                @foreach($menus as $menu)
		                    <tr>
		                        <td>{!! $menu['label'] !!}</td>
		                        <td style="text-align: center;">
		                        	@can('edit-menus')
		            				<a href="menus/{{$menu['value']}}/edit" class="btn btn-info btn-xs">edit</a>
		            				@endcan
		            	
					            	@can('delete-menus')
					            	<a href="menus/{{$menu['value']}}/delete" class="btn btn-info btn-xs" onclick="confirmation(event)">delete</a>
					            	@endcan
		                        </td>
		                    </tr>
		                @endforeach
	               </table>
	            </div>
            </div>
		</div>
	</div>
@stop

@section('plugins.Sweetalert2', true)

@section('js')
    <script>
    	$(function() {
    		alertAutoCLose()
		});
    </script>
@stop