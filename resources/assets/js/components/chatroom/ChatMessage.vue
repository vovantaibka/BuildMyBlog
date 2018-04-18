<template>
	<div>
		<div v-if="user.id === message.user.id">
			<div class="message sent">
				<img :src="image" :alt="user.name" :title="user.name">
				<p>{{ message.message }}</p>
			</div>
		</div>
		<div v-else>
			<div class="message replies">
				<img :src="image" :alt="message.user.name" :title="message.user.name">
				<p>{{ message.message }}</p>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: [
		'message',
		'user'
	],
	data: function() {
		return {
			image: this.message.user.image
		}
	}
}
</script>