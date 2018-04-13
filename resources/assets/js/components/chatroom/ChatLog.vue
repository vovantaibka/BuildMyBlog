<template>
	<div id="messages" class="messages">
		<chat-message v-for="message in messages" v-bind:data="message" v-bind:key="message.id" :message="message" :user="user"></chat-message>
		<div id="fix-scroll"></div>
	</div>
</template>

<script>
	export default {
		props: ['messages', 'user']
	}
</script>