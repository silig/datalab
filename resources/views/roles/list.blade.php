@extends('layouts.admin')

@section('title', 'Roles')

@section('content_header')
    <h1>Roles</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			@include('widgets.message')
		    <table class="table table-striped" id="data-table" width="100%">
	            <thead>
		            <tr>
		                <th width="10%">ID</th>
		                <th width="90%">Name</th>
		            </tr>
		        </thead>
		        <thead id="searchid">
	               	<tr>
	                  	<td></td>
	                  	<td></td>
	               	</tr>
	            </thead>
		    </table>
		</div>
	</div>
@stop

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('js')
    <script>
    	$(function() {
    		alertAutoCLose()
    		var create = '';

			@can('create-roles')
	        create += '<a class="btn btn-success btn-sm" href="roles/create"><i class="fa fa-plus"></i> Create</a>';
	        @endcan

		    var tb = $('#data-table').DataTable({
		        processing: true,
		        serverSide: true,
		        language: {
		         	search: "",
		         	lengthMenu: '_MENU_ &nbsp; '+create
		      	},
		        ajax: 'roles',
		        columns: [
		        	{ data: 'id', name: 'id'},
		            { data: 'name', name: 'name', render: function (data, type, row, meta) {
		            	var buttons = '';

		            	@can('edit-roles')
		            	buttons += '<a href="roles/'+row.id+'/edit" class="btn btn-info btn-xs">edit</a> ';
		            	@endcan
		            	
		            	@can('delete-roles')
		            	buttons += '<a href="roles/'+row.id+'/delete" class="btn btn-info btn-xs" onclick="confirmation(event)">delete</a>';
		            	@endcan
		            	
		            	return '<div>'+row.name+'</div><div class="action-button"> '+buttons+' </div>';
		            }}
		        ]
		    });

		    $('#data-table #searchid td').each(function() {
		        $(this).html('<input type="text" class="form-control form-control-sm" data-id="'+$(this).index()+'"/>');
		   	});

		   	$('#data-table #searchid input').keyup(debounce(function () {
		      	tb.columns($(this).data('id')).search(this.value).draw();
		   	}, 500));
		});
    </script>
@stop