@extends('main')

@section('title', '| Zoom Image')

@section('stylesheets')
{!!Html::style('css/test.css')!!}
@endsection

@section('content')
<h3>Thumbnail Images</h3>
<ul class="list-inline gallery">    
	<li><img class="thumbnail zoom" src="https://placeimg.com/110/110/abstract/1"></li>    
	<li><img class="thumbnail zoom" src="https://placeimg.com/110/110/abstract/2"></li>    
	<li><img class="thumbnail zoom" src="https://placeimg.com/110/110/abstract/3"></li>    
	<li><img class="thumbnail zoom" src="https://placeimg.com/110/110/abstract/4"></li>  
</ul>
@endsection