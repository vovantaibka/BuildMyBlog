<template>
	<div class="chat-composer">
		<input type="text" name="" placeholder="Start typing your message" v-model="messageText" @keyup.enter="sendMessage">
		<button type="submit" class="btn btn-primary" @click="sendMessage">Send</button>
	</div>
</template>

<script>
	export default {
		data: function() {
			return {
				messageText: ''
			}
		},
		methods: {
			sendMessage() {
				this.$emit('messagesent', {
					message: this.messageText,
					user: $('a[id=dropdownMenu]').text()
				})
				this.messageText = '';
			}
		}
	}
</script>

<style type="text/css">
	.chat-composer {
		display: flex;
	}

	.chat-composer input {
		flex: 1 auto;
	}

	.chat-composer button {
		border-radius: 0;
	}
</style>