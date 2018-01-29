<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials._head')
</head>

<body>
@include('partials._nav')

@yield('process')

<div id="wrapper">
    @include('partials._messages')

    <div id="body">
        @yield('content')
    </div>

    <div id="footer">
        @include('partials._footer')
    </div>
</div><!-- end of .container -->

@include('partials._javascript')
@yield('scripts')
</body>
</html>