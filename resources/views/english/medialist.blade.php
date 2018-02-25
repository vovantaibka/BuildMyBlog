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