@extends('layouts.admin')

@section('title', 'Menus')

@section('content_header')
    <h1>Data {{$folder->nama_folder}}</h1>
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
		                    <th width="40%" style="text-align: center;">Nama Files</th>
		                    <th width="40%" style="text-align: center;">Data Files</th>
		                    <th width="20%" style="text-align: center;">Action</th>
		                </tr>
		                @foreach($file as $files)
		                    <tr>
		                        <td>{!! $files->nama_data !!}</td>
		                        <td>{!! $files->file !!}</td>
		                        <td style="text-align: center;">
		                        	@can('edit-menus')
		            				<a href="files/{{$files['id']}}/edit" class="btn btn-info btn-xs">open</a>
		            				@endcan

		                        	@can('edit-menus')
		            				<a href="#" data-toggle="modal" data-target="#modal-edit{{$files['id']}}" class="btn btn-info btn-xs">edit</a>
		            				@endcan
		            	
					            	@can('delete-menus')
					            	<a href="{{ route('delete_file', [ $folder->id, $files['id']]) }}" class="btn btn-info btn-xs" onclick="confirmation(event)">delete</a>
					            	@endcan
		                        </td>
		                    </tr>

		                    <div class="modal fade" id="modal-edit{{$files['id']}}" style="display: none;" aria-hidden="true">
						        <div class="modal-dialog">
						          <div class="modal-content">
						            <div class="modal-header">
						              <h4 class="modal-title">Edit Folder</h4>
						              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						                <span aria-hidden="true">×</span>
						              </button>
						            </div>
						            <div class="modal-body">
						              <form action="#" method="post" enctype="multipart/form-data">
						              	@csrf
						              	<div class="row">
									  		<div class="col-12">
												<div class="form-group">
										    		<label>Folder Name*</label>
										    		<input type="text" name="nama_folder" class="form-control" value="{!! $files['nama_folder'] !!}">
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
              <h4 class="modal-title">Tambah File</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="form-folder" action="{{route('input_file')}}" method="post" enctype="multipart/form-data">
              	@csrf
              	<div class="row">
			  		<div class="col-12">
						<div class="form-group">
				    		<label>Nama File*</label>
				    		<input type="text" name="nama_file" class="form-control">
				    		<input type="text" name="id_folder" class="form-control" value="{{$folder->id}}" hidden="">
				  		</div>
			  		</div>
	  			</div>

	  			<div class="row">
			  		<div class="col-12">
						<div class="form-group">
				    		<label>File*<small><i></i></small></label></label> <br>
				    		
				    		<div class="custom-file">
		                      <input type="file" class="custom-file-input" id="customFile" name="file">
		                      <label class="custom-file-label" for="customFile">Choose file</label>
		                    </div>
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
<script src="{{ asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function () {
	  bsCustomFileInput.init();
	});
</script>
@if(!empty($successMessage = \Illuminate\Support\Facades\Session::get('salah')))
    <script>
        $(function () {
            @if($successMessage)
                alert('{{ $successMessage }}');
            @endif
        });
    </script>
@endif
    <script>
    	$(function() {
    		alertAutoCLose()
		});
    </script>
@stop