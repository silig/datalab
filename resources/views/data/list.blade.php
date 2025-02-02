@extends('layouts.admin')

@section('title', 'Menus')

@section('content_header')
    <h1>Data</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			@include('widgets.message')
			@include('widgets.error')
			<div class="row">
			    <div class="col-12" style="margin-bottom: 20px;">
			    	@can('create-menus')
			    	<a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Create</a>
			    	@endcan
			    </div>
			    <div class="col-12">
	               <table class="table table-bordered table-striped">
		                <tr>
		                    <th width="60%" style="text-align: center;">Folder</th>
		                    <th width="40%" style="text-align: center;">Action</th>
		                </tr>
		                @foreach($menus as $menu)
		                    <tr>
		                        <td>{!! $menu['nama_folder'] !!}</td>
		                        <td style="text-align: center;">
		                        	@can('edit-menus')
		            				<a href="data/{{$menu['id']}}/files" class="btn btn-info btn-xs">open</a>
		            				@endcan

		                        	@can('edit-menus')
		            				<a href="#" data-toggle="modal" data-target="#modal-edit{{$menu['id']}}" class="btn btn-info btn-xs">edit</a>
		            				@endcan
		            	
					            	@can('delete-menus')
					            	<a href="data/{{$menu['id']}}/delete" class="btn btn-info btn-xs" onclick="confirmation(event)">delete</a>
					            	@endcan
		                        </td>
		                    </tr>

		                    <div class="modal fade" id="modal-edit{{$menu['id']}}" style="display: none;" aria-hidden="true">
						        <div class="modal-dialog">
						          <div class="modal-content">
						            <div class="modal-header">
						              <h4 class="modal-title">Edit Folder</h4>
						              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						                <span aria-hidden="true">×</span>
						              </button>
						            </div>
						            <div class="modal-body">
						              <form class="edit" action="{{route('edit_data', [$menu['id']] )}}" method="post">
						              	@csrf
						              	<div class="row">
									  		<div class="col-12">
												<div class="form-group">
										    		<label>Folder Name*</label>
										    		<input type="text" name="nama_folder" class="form-control" value="{!! $menu['nama_folder'] !!}">
										  		</div>
									  		</div>
							  			</div>
						              
						            </div>
						            <div class="modal-footer justify-content-between">
						              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						              <button type="submit" class="btn btn-primary">Save changes</button>
						            </div>
						            </form>
						          </div>

						        </div>
						    </div>
		                @endforeach
	               </table>
	            </div>
            </div>
		</div>
	</div>


	<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Folder</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="buat" id="form-folder" action="{{route('input_data')}}" method="post">
              	@csrf
              	<div class="row">
			  		<div class="col-12">
						<div class="form-group">
				    		<label>Folder Name*</label>
				    		<input type="text" name="nama_folder" class="form-control">
				  		</div>
			  		</div>
	  			</div>
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop

@section('plugins.Sweetalert2', true)

@section('js')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
{!! $validator->selector('.buat') !!}
{!! $validator->selector('.edit') !!}
    <script>
    	$(function() {
    		alertAutoCLose()
		});
    </script>
@stop