<template>
	<div id="chat-room">
		<div class="sidepanel">
			<div id="profile">
				<div class="wrap">
					<img id="profile-img" class="online" :src="imageUser">
					<p>{{ user.name }}</p>
					<div class="expand">
						<svg class="svg-icon" viewBox="0 0 20 20">
							<path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
						</svg>
					</div>
				</div>
			</div>
		</div>
		<div class="container-message">
			<div class="contact-profile">
				<img :src="imageUser">
				<p>{{ user.name }}</p>
				<div class="social-media">
					<svg class="svg-icon" viewBox="0 0 20 20">
						<path fill="none" d="M11.344,5.71c0-0.73,0.074-1.122,1.199-1.122h1.502V1.871h-2.404c-2.886,0-3.903,1.36-3.903,3.646v1.765h-1.8V10h1.8v8.128h3.601V10h2.403l0.32-2.718h-2.724L11.344,5.71z"></path>
					</svg>
					<svg class="svg-icon" viewBox="0 0 20 20">
						<path fill="none" d="M18.258,3.266c-0.693,0.405-1.46,0.698-2.277,0.857c-0.653-0.686-1.586-1.115-2.618-1.115c-1.98,0-3.586,1.581-3.586,3.53c0,0.276,0.031,0.545,0.092,0.805C6.888,7.195,4.245,5.79,2.476,3.654C2.167,4.176,1.99,4.781,1.99,5.429c0,1.224,0.633,2.305,1.596,2.938C2.999,8.349,2.445,8.19,1.961,7.925C1.96,7.94,1.96,7.954,1.96,7.97c0,1.71,1.237,3.138,2.877,3.462c-0.301,0.08-0.617,0.123-0.945,0.123c-0.23,0-0.456-0.021-0.674-0.062c0.456,1.402,1.781,2.422,3.35,2.451c-1.228,0.947-2.773,1.512-4.454,1.512c-0.291,0-0.575-0.016-0.855-0.049c1.588,1,3.473,1.586,5.498,1.586c6.598,0,10.205-5.379,10.205-10.045c0-0.153-0.003-0.305-0.01-0.456c0.7-0.499,1.308-1.12,1.789-1.827c-0.644,0.28-1.334,0.469-2.06,0.555C17.422,4.782,17.99,4.091,18.258,3.266"></path>
					</svg>
					<svg class="svg-icon" viewBox="0 0 20 20">
						<path fill="none" d="M14.52,2.469H5.482c-1.664,0-3.013,1.349-3.013,3.013v9.038c0,1.662,1.349,3.012,3.013,3.012h9.038c1.662,0,3.012-1.35,3.012-3.012V5.482C17.531,3.818,16.182,2.469,14.52,2.469 M13.012,4.729h2.26v2.259h-2.26V4.729z M10,6.988c1.664,0,3.012,1.349,3.012,3.012c0,1.664-1.348,3.013-3.012,3.013c-1.664,0-3.012-1.349-3.012-3.013C6.988,8.336,8.336,6.988,10,6.988 M16.025,14.52c0,0.831-0.676,1.506-1.506,1.506H5.482c-0.831,0-1.507-0.675-1.507-1.506V9.247h1.583C5.516,9.494,5.482,9.743,5.482,10c0,2.497,2.023,4.52,4.518,4.52c2.494,0,4.52-2.022,4.52-4.52c0-0.257-0.035-0.506-0.076-0.753h1.582V14.52z"></path>
					</svg>
				</div>
			</div>
			<chat-log :messages="messages" :user="user"></chat-log>
			<chat-composer v-on:messagesent="addMessage"></chat-composer>
		</div>
	</div>
</template>

<script>
export default {
	data: function() {
		return {
			user: {
				id: '',
				name: '',
				image: ''
			},
			messages: [],
			imageUser: ''
		}
	},
	methods: {
		addMessage(message) {
			var app = this

			var messageSent = {
				message: message.message,
				user: app.user
			}

			app.messages.push(messageSent);

			axios.post('/messages', message)
			.then(function(refs) {})
			.catch(function(refs) {
				console.log(refs)
			})

			$("#messages").scrollTop($("#messages")[0].scrollHeight);
		}
	},
	created() {
		var app = this
		
		axios.get('/messages')
		.then(function(refs) {
			app.user = refs.data.user

			app.messages = refs.data.messages

			app.imageUser = imgsUrl + "/" + refs.data.user.image
		})
		.catch(function(refs) {
			console.log(refs)
		})

		Echo.join('chatroom')
		.listen('MessagePosted', (e) => {

			//Handle event
			app.messages.push({
				message: e.message.message,
				user: e.user
			})

			$("#messages").scrollTop($("#messages")[0].scrollHeight);
		});
	}
} 
</script>