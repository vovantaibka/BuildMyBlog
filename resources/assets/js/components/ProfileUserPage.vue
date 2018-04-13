<template>
	<div id="account-info">
		<div class="wrap">
		</div>
		<b-row class="content">
			<h1>Profile</h1>
			<b-col md="4" class="avatar">
				<b-img :src="image" id="profile_image_tag" class="form-spacing-top"></b-img>
				<b-form-file id="profile_image" @change="changeProfileImage" class="mt-3" plain></b-form-file>
				<b-button type="button" @click="uploadFile">Upload File</b-button>
			</b-col>
			<b-col md="8" class="profile">
				<b-form class="form" @submit="updateInfo">
					<b-row>
						<b-col md="6">
							<b-form-input id="full-name" v-model.trim="user.name" placeholder="Full Name"></b-form-input>
						</b-col>
						<b-col md="6">
							<b-form-input id="birth-day" type="date" v-model.trim="user.birth_day" placeholder="Birth Day"></b-form-input>	
						</b-col>
					</b-row>
					<b-row>
						<b-col md="6">
							<b-form-input id="phone" v-model.trim="user.phone" placeholder="Phone Number"></b-form-input>
						</b-col>
						<b-col md="6">
							<b-form-select v-model="user.gender" :options="options" class="mb-3" />
						</b-col>
					</b-row>
					<b-row>
						<b-col md="12">
							<b-form-input id="address" v-model.trim="user.address" placeholder="Address"></b-form-input>
						</b-col>
					</b-row>
					<b-row>
						<b-col md="12">
							<b-form-input id="user-email" type="email" v-model.trim="userEmail" placeholder="Email" disabled></b-form-input>
						</b-col>
					</b-row>
					<b-row>
						<b-col md="12">
							<b-form-input id="change-pass" type="password" v-model.trim="user.password" placeholder="Password"></b-form-input>
						</b-col>
					</b-row>
					<b-row class="button">
						<b-col md="12">
							<b-button-group>
								<b-button type="submit">Update Info</b-button>
								<b-button type="button" @click="resetForm">Reset Form</b-button>
							</b-button-group>
						</b-col>
					</b-row>
				</b-form>
			</b-col>
		</b-row>
	</div>
</template>

<script>
export default {
	data: function() {
		return {
			options: [
			{ value: 'female', text: 'Female' },
			{ value: 'male', text: 'Male' },
			{ value: 'custom', text: 'Custom' }
			],
			user: {
				name: '',
				birth_day: '',
				address: '',
				phone: '',
				gender: '',
				password: ''
			},
			userId: '',
			userEmail: '',
			image: '',
			file: null
		}
	},
	created() {
		var app = this
		app.userId = this.$parent._route.params.userId

		axios.get('/account/' + app.userId)
		.then(function(refs) {
			app.user = refs.data
			app.userEmail = refs.data.email
			app.image = imgsUrl + "/" + refs.data.image
		})
		.catch(function(refs) {
			console.log(refs)
		})
	},
	methods: {
		changeProfileImage(e) {
			let files = e.target.files || e.dataTransfer.files;
			if (!files.length)
				return;
			this.createImage(files[0]);
		},
		createImage(file) {
			let reader = new FileReader();
			let vm = this;
			reader.onload = (e) => {
				vm.file = e.target.result;
			};
			reader.readAsDataURL(file);
		},
		uploadFile() {
			var app = this

			axios.put('/upload-image-file/' + app.userId, { image: app.file})
			.then(function(refs) {
				app.image = imgsUrl + "/" + refs.data.fileImageName
			})
			.catch(function(refs) {
				console.log(refs)
			})
		},	
		updateInfo() {
			var app = this
			
			axios.patch('/account/' + app.userId, app.user)
			.then(function(refs) {
				console.log('success');
			})
			.catch(function(refs) {
				console.log(refs)
			})
		},
		resetForm() {
			var app = this

			Object.keys(app.user).forEach(function(key,index) {
				app.user[key] = ''
			});
		}
	}
}
</script>