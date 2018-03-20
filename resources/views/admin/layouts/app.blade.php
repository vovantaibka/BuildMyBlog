<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>My Blog @yield('title')</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!-- JQuery -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

	{!!Html::style('css/parsley.css')!!}
	{!!Html::style('css/select2.min.css')!!}
	{!!Html::style('css/admin-styles.css')!!}

	<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5g5faf78gvk6yfq9bd3bbfjo858kjx1q8o0nbiwtygo2e4er'></script>

	<!-- Scripts -->
	<script>
	    window.Laravel = {!! json_encode([
	        'csrfToken' => csrf_token(),
	    ]) !!};
	</script>
</head>

<body>
	@include('admin.partials._nav')
	@include('modals.confirm')

	<div id="wrapper">
		@include('partials._messages')
		<div class="container-fluid">
			<div class="row" id="admin-app">
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