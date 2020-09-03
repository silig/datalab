@if(count($errors) > 0)
  	@foreach ($errors->all() as $error)
  		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>	
			<strong>{{ $error }}</strong>
		</div>
  	@endforeach
@endif