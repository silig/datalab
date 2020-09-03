@extends('layouts.admin')

@section('title', 'Permissions')

@section('content_header')
    <h1>Permissions</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			@include('widgets.message')
		    <table class="table table-striped" id="data-table">
	            <thead>
		            <tr>
		                <th width="10%">ID</th>
		                <th width="20%">Name</th>
		                <th width="40%">Alias</th>
		                <th width="40%">Menu</th>
		            </tr>
		        </thead>
		        <thead id="searchid">
	               	<tr>
	                  	<td></td>
	                  	<td></td>
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

			@can('create-permissions')
	        create += '<a class="btn btn-success btn-sm" href="permissions/create"><i class="fa fa-plus"></i> Create</a>';
	        @endcan

		    var tb = $('#data-table').DataTable({
		        processing: true,
		        serverSide: true,
		        language: {
		         	search: "",
		         	lengthMenu: '_MENU_ &nbsp;'+create
		      	},
		        ajax: 'permissions',
		        columns: [
		        	{ data: 'id', name: 'id'},
		            { data: 'name', name: 'name', render: function (data, type, row, meta) {
		            	var buttons = '';

		            	@can('edit-permissions')
		            	buttons += '<a href="permissions/'+row.id+'/edit" class="btn btn-info btn-xs">edit</a> ';
		            	@endcan
		            	
		            	@can('delete-permissions')
		            	buttons += '<a href="permissions/'+row.id+'/delete" class="btn btn-info btn-xs" onclick="confirmation(event)">delete</a>';
		            	@endcan
		            	
		            	return '<div>'+row.name+'</div><div class="action-button"> '+buttons+' </div>';
		            }},
		            { data: 'alias', name: 'alias' },
		            { data: 'menu.name', name: 'menu.name' }
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