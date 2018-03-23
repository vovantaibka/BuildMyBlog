<template>
	<b-container fluid>
		<div id="listen-read" class="container">
			<b-row no-gutters>
				<b-col md="8">
					<h2>Listen & Read</h2>
					<div class="" style="display: inline-block;" v-for="category in categories">
						<b-nav pills>
							<b-nav-item>
								<input type="hidden" name="category_id" :value="category.id ">
								<a href="#">{{ category.name }}</a>
							</b-nav-item>
						</b-nav>
					</div>
					<hr>
					<ul class="media-list">
						<div v-for="audio in audios" v-if="audios.length > 0">
							<li class="media">
								<!-- <a href="{{ route('english.single', $audio->slug) }}" class="pull-left">
									<img src="{{ asset('imgs/' . $audio->image) }}" class="media-object">
								</a> -->
								<aside class="media-body">
									<h3 class="media-heading">
										<!-- <a href="{{ route('english.single', $audio->slug) }}">{{ $audio->title }}</a> -->
									</h3>
									<!-- <time>Poster: {{ Carbon\Carbon::parse($audio->created_at)->format('d-m-Y') }}</time> -->
									<p>{{ audio.introduce }}</p>
								</aside>
							</li>
						</div>
					</ul>
				</b-col>
			</b-row>
		</div>
	</b-container>
</template>

<script>
export default {
	data: function() {
		return {
			audios: [],
			categories: []
		}
	},
	mounted() {
		var app = this
		axios.get('/listen')
		.then(function(refs) {
			app.audios = refs.data.audios
			app.categories = refs.data.categories
		})
		.catch(function(refs) {
			console.log(refs)
		})
	}
}
</script>