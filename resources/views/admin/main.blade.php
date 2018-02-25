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
			<div class="row">
				@include('admin.partials._sidebar')
				@yield('content')
			</div>
		</div>
	</div>
	
	<div id="scripts">
		@include('admin.partials._javascript')
		@yield('scripts')
	</div>
</body>
</html>