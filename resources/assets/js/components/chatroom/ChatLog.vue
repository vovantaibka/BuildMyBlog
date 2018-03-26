<template>
	<div class="chat-log">
		<chat-message v-for="message in messages" v-bind:data="message" v-bind:key="message.id" :message="message" :userName="userName"></chat-message>
		<div class="empty" v-show="messages.length === 0">
			Nothing here yet!
		</div>
	</div>
</template>

<script>
	export default {
		props: ['messages', 'userName']
	}
</script>

<style type="text/css">
	.chat-log .chat-message:nth-child(even) {
		background-color: #ccc;
	}
	.empty {
		padding: 1rem;
		text-align: center;
	}
</style>