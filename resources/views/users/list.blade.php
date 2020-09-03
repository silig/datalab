@extends('layouts.admin')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			@include('widgets.message')
		    <table class="table table-striped" id="data-table" width="100%">
	            <thead>
		            <tr>
		                <th>ID</th>
		                <th>Name</th>
		                <th>Role</th>
		                <th>Active</th>
		                <th>Action</th>
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

			@can('create-users')
	        create += '<a class="btn btn-success btn-sm" href="users/create"><i class="fa fa-plus"></i> Create</a>';
	        @endcan

		    var tb = $('#data-table').DataTable({
		        processing: true,
		        serverSide: true,
		        language: {
		         	search: "",
		         	lengthMenu: '_MENU_ &nbsp; '+create
		      	},
		        ajax: 'users',
		        columns: [
		            { data: 'id', name: 'id'},
		            { data: 'username', name: 'username'},
		            { data: 'role.name', name: 'role.name' },
		            { data: 'active', name: 'active' },
		            { render: function (data, type, row, meta) {
		            	var buttons = '';

		            	@can('edit-users')
		            	buttons += '<a href="users/'+row.id+'/edit" class="btn btn-info btn-xs">edit</a> ';
		            	@endcan
		            	
		            	@can('delete-users')
		            	buttons += '<a href="users/'+row.id+'/delete" class="btn btn-info btn-xs" onclick="confirmation(event)">delete</a>';
		            	@endcan
		            	
		            	return '<div class="action-button" style="opacity:100"> '+buttons+' </div>';
		            }},
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