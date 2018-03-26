<template>
	<div class="chat-message">
		<p>{{ message.message }}</p>
		<small>{{ userName }}</small>
	</div>
</template>

<script>
	export default {
		props: [
			'message',
			'userName'
		],
	}
</script>

<style type="text/css">
	.chat-message {
		padding: 1rem;
	}
	.chat-message > p {
		margin-bottom: .5rem;
	}
</style>