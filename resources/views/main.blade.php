<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials._head')
</head>

<body>
@yield('process')

<div id="wrapper">
    @include('partials._messages')

	<div id="app">
    	@yield('content')
	</div>

    <div id="footer">
        @include('partials._footer')
    </div>
</div><!-- end of .container -->

<div id="scripts">
	@include('partials._javascript')
	@yield('scripts')
</div>

<!-- Script -->
<script type="text/javascript">
	var baseUrl = '{{ url('/') }}';
    var imgsUrl = '{{ url('/imgs') }}';
</script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>