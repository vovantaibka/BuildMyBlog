<template>
	<div id="chat-room">
		<h1>Chat room</h1>
		<chat-log :messages="messages" :userName="userName"></chat-log>
		<chat-composer v-on:messagesent="addMessage"></chat-composer>
	</div>
</template>

<script>
export default {
	data: function() {
		return {
			userName: '',
			messages: [],
			usersInRoom: []
		}
	},
	mounted() {
		var app = this
		
		axios.get('/messages')
			.then(function(refs) {
				app.messages = refs.data.messages
				app.userName = refs.data.userName
			})
			.catch(function(refs) {
				console.log(refs)
			})

		Echo.join('chatroom')
			.here((users) => {
				this.usersInRoom = users
			})
			.joining()
			.leaving()
			.listen('MessagePosted', (e) => {
				//Handle event
				this.messages.push({
					message: e.message.message,
					user: e.user
				})
			});
	},
	methods: {
		addMessage(message) {
			var app = this
			app.messages.push(message);

			axios.post('/messages', message)
				.then(function(refs) {
				})
				.catch(function(refs) {
					console.log(refs)
				})
		}
	}
} 
</script>