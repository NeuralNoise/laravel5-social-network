@if (Session::has('info'))
	<div class="alert alert-info alert-dismissable" role="alert">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{ Session::get('info') }}
	</div>
@endif