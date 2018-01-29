<!DOCTYPE html>
<html lang="en">
<head>
	@include('admin.partials._head')
</head>

<body>
	@include('admin.partials._nav')

	<div id="wrapper">
		<div class="container-fluid">
			<div class="row">
				@include('admin.partials._sidebar')
				@yield('content')
			</div>
		</div>
	</div>
	
	@include('admin.partials._javascript')
	@yield('scripts')
</body>
</html>