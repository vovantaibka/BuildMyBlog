@extends('main')

@section('title', '| Listen And Read')

@section('content')
<div id="listen-read" class="container">
	<div class="row">
		<div class="col-md-8">
			<h2>Listen & Read</h2>
			<ul class="nav nav-pills">
				@foreach($categories as $category)
				<li role="presentation">
					<input type="hidden" name="category_id" value="{{ $category->id }}">
					<a href="#">{{ $category->name }}</a>
				</li>
				@endforeach
			</ul>
			<hr>
			<ul class="media-list">
				@if(count($audios) > 0)
				@foreach($audios as $audio)
				<li class="media">
					<a href="{{ route('english.single', $audio->slug) }}" class="pull-left">
						<img src="{{ asset('imgs/' . $audio->image) }}" class="media-object">
					</a>
					<aside class="media-body">
						<h3 class="media-heading">
							<a href="{{ route('english.single', $audio->slug) }}">{{ $audio->title }}</a>
						</h3>
						<time>Poster: {{ Carbon\Carbon::parse($audio->created_at)->format('d-m-Y') }}</time>
						<p>{{ $audio->introduce }}</p>
					</aside>
				</li>
				@endforeach
				@endif
			</ul>
		</div>
	</div>
	@endsection

	@section('scripts')
	<script src="{{asset('js/english.js')}}"></script>
	@endsection