<!DOCTYPE html>
<html lang="en">
<head>
	@include('admin.partials._head')
</head>

<body>
	@include('admin.partials._nav')
	@include('modals.confirm')

	<div id="wrapper">
		@include('partials._messages')
		<div class="container-fluid">
			<div class="row" id="admin-app">
				{{-- @include('admin.partials._sidebar') --}}
				@yield('content')
			</div>
		</div>
	</div>
	
	<div id="scripts">
		@include('admin.partials._javascript')
		@yield('scripts')
	</div>

	<!-- Script -->
	<script>
		var baseUrl = '{{ url('/') }}';
        var apiUrl = '{{ url('/api') }}';
        var userId = {{ Auth::user() ? Auth::user()->id : 'null' }};
	</script>
	<script src="{{ asset('js/admin-app.js') }}"></script>
</body>
</html>