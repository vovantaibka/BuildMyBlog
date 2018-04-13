<template>
	<div class="container">
		<div id="search-create">
			<b-form @submit.prevent="websiteCrawler">
				<b-card no-body
				header="Start a new crawler"
				title="Entry point url"
				style="max-width: 100%">	
				<b-card-body>
					<b-form-group id=""
					label="Entry point url"
					label-for="entrypoint">
					<b-form-input id="entrypoint"
					type="url"
					v-model="entrypoint"
					required
					placeholder="http://...">
				</b-form-input>
				<b-button type="submit" variant="primary">Crawler</b-button>
			</b-form-group>
			<b-form-group id="" label="Resource type to find">
				<b-form-radio-group v-model="type"
				name="type"
				id="email-radio">
				<b-form-radio value="url">Urls</b-form-radio>
				<b-form-radio value="email">Emails</b-form-radio>
				<b-form-radio value="comment">Comments</b-form-radio>
			</b-form-radio-group>
						</b-form-group>
					</b-card-body>
				</b-card>
			</b-form>
		</div>
		<search-result-comment v-if="isSearchComment" :entrypoint="entrypoint" :searches="searches"></search-result-comment>
	</div>
</template>

<script>
var csrf_token = $('meta[name="csrf-token"]').attr('content');

export default {
	data: function() {
		return {
			entrypoint: '',
			type: '',
			token: csrf_token,
			searches: [],
			isSearchComment: false
		}
	},
	methods: {
		websiteCrawler: function() {
			var request = {
				entrypoint: this.entrypoint,
				type: this.type,
				_token: this.token
			};

			if(this.type === 'comment') {
				this.isSearchComment = true;
			}

			$.post(apiUrl + "/crawlersite", request).done(function(response) {
				console.log(response)
				this.searches = response.searches
			});
		}
	}
}
</script>

<style scoped>
#entrypoint {
	float: left;
	width: 90%;
}
input[type=submit] {
	float: right;
}
</style>