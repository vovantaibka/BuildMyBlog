<template>
	<div class="chat-composer">
		<div class="wrap">
			<input v-model="message"
			type="text"
			placeholder="Start typing your message"
			v-on:keyup.enter="sendMessage">
			<b-button size="md" variant="success"  @click="sendMessage">
				<svg class="svg-icon" viewBox="0 0 20 20">
				<path d="M17.218,2.268L2.477,8.388C2.13,8.535,2.164,9.05,2.542,9.134L9.33,10.67l1.535,6.787c0.083,0.377,0.602,0.415,0.745,0.065l6.123-14.74C17.866,2.46,17.539,2.134,17.218,2.268 M3.92,8.641l11.772-4.89L9.535,9.909L3.92,8.641z M11.358,16.078l-1.268-5.613l6.157-6.157L11.358,16.078z"></path>
				</svg>
			</b-button>
		</div>
	</div>
</template>

<script>
export default {
	data: function() {
		return {
			message: ''
		}
	},
	methods: {
		sendMessage() {
			var app = this;
			this.$emit('messagesent', {
				message: app.message.trim()
			})
			this.message = '';
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