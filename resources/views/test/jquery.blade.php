@extends('main')

@section('title', "| Tutorial jQuery")

@section('content')
<p class="intro">Việt Nam vô địch</p>
<p id="lastname">U23 Việt Nam thắng U23 Uzbekistan</p>
<p>Việt Nam tham dự World Cup 2022</p>

<button type="button" class="btn btn-primary">Button</button>

<script type="text/javascript">
	$(function() {
		$("button").click(function() {
			$(".intro, #lastname").css('color', 'red');
		})
	})
</script>
@endsection