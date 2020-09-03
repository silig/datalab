@extends('adminlte::page')

@section('footer')
    <b>2020 admin panel.</b>
    <script>
		function debounce(func, wait, immediate) {
		    var timeout;
		    return function() {
		        var context = this, args = arguments;
		        var later = function() {
		            timeout = null;
		            if (!immediate) func.apply(context, args);
		        };
		        var callNow = immediate && !timeout;
		        clearTimeout(timeout);
		        timeout = setTimeout(later, wait);
		        if (callNow) func.apply(context, args);
		    };
		};

		function confirmation(ev) {
			ev.preventDefault();
			var urlToRedirect = ev.currentTarget.getAttribute('href'); 
			Swal.fire({
			  	title: 'Are you sure to delete it?',
			  	text: '',
			  	showCancelButton: true,
			  	confirmButtonText: 'Yes, delete it!',
			  	cancelButtonText: 'No, keep it!'
			})
			.then(function(willDelete) {
			  	if (willDelete.value) {
			    	window.location.href = urlToRedirect;
			  	}
			});
		}

		function alertAutoCLose() {
			$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
			    $(".alert-success").slideUp(500);
			});
		}
	</script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style type="text/css">
    	.action-button{
    		font-size: 12px;
    		opacity: 0;
    	}
    	.action-button:hover{
    		font-size: 12px;
    		color: #869099;
    		opacity: 1;
    	}
    </style>
@stop