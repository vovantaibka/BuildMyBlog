<template>
	<div id="info-contact">
			<div class="image">
		        <img src="imgs/black-and-white-man-person-hands.jpg">
		    </div>
		    <div class="row info">
		        <div class="col-md-8 col-md-offset-2">
		            <div class="title">
		                <span><strong>Info.</strong></span>
		            </div>
		            <span class="about">"Là một đứa sinh viên Bách Khoa HN năm 3. Tự cảm thấy bản thân phù hợp với nghề lập trình hơn bất cứ
		                thứ
		                gì khác. Suốt ngày chỉ cắm đầu bên chiếc laptop. Sống khá khép kín hay mọi người thường bảo là tự
		                kỷ.
		                Blog này là thành quả đầu tiên của tôi khi học lập trình Web. Là một thứ gì đó khiến cho cuộc sống
		                của
		                lập trình viên đỡ tẻ nhạt hơn. Là nơi tôi chia sẻ kinh nghiệm, suy nghĩ cũng như những thứ tôi trân
		            trọng."</span>
		            <div class="contact">
		                <div class="social-nw">
                            <ul class="">
                                <li>
                                    <a href="">
                                        <svg class="svg-icon" viewBox="0 0 20 20">
                                        <path fill="none" d="M11.344,5.71c0-0.73,0.074-1.122,1.199-1.122h1.502V1.871h-2.404c-2.886,0-3.903,1.36-3.903,3.646v1.765h-1.8V10h1.8v8.128h3.601V10h2.403l0.32-2.718h-2.724L11.344,5.71z"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <svg class="svg-icon" viewBox="0 0 20 20">
                                        <path fill="none" d="M8.937,10.603c-0.383-0.284-0.741-0.706-0.754-0.837c0-0.223,0-0.326,0.526-0.758c0.684-0.56,1.062-1.297,1.062-2.076c0-0.672-0.188-1.273-0.512-1.71h0.286l1.58-1.196h-4.28c-1.717,0-3.222,1.348-3.222,2.885c0,1.587,1.162,2.794,2.726,2.858c-0.024,0.113-0.037,0.225-0.037,0.334c0,0.229,0.052,0.448,0.157,0.659c-1.938,0.013-3.569,1.309-3.569,2.84c0,1.375,1.571,2.373,3.735,2.373c2.338,0,3.599-1.463,3.599-2.84C10.233,11.99,9.882,11.303,8.937,10.603 M5.443,6.864C5.371,6.291,5.491,5.761,5.766,5.444c0.167-0.192,0.383-0.293,0.623-0.293l0,0h0.028c0.717,0.022,1.405,0.871,1.532,1.89c0.073,0.583-0.052,1.127-0.333,1.451c-0.167,0.192-0.378,0.293-0.64,0.292h0C6.273,8.765,5.571,7.883,5.443,6.864 M6.628,14.786c-1.066,0-1.902-0.687-1.902-1.562c0-0.803,0.978-1.508,2.093-1.508l0,0l0,0h0.029c0.241,0.003,0.474,0.04,0.695,0.109l0.221,0.158c0.567,0.405,0.866,0.634,0.956,1.003c0.022,0.097,0.033,0.194,0.033,0.291C8.752,14.278,8.038,14.786,6.628,14.786 M14.85,4.765h-1.493v2.242h-2.249v1.495h2.249v2.233h1.493V8.502h2.252V7.007H14.85V4.765z"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <svg class="svg-icon" viewBox="0 0 20 20">
                                        <path fill="none" d="M18.258,3.266c-0.693,0.405-1.46,0.698-2.277,0.857c-0.653-0.686-1.586-1.115-2.618-1.115c-1.98,0-3.586,1.581-3.586,3.53c0,0.276,0.031,0.545,0.092,0.805C6.888,7.195,4.245,5.79,2.476,3.654C2.167,4.176,1.99,4.781,1.99,5.429c0,1.224,0.633,2.305,1.596,2.938C2.999,8.349,2.445,8.19,1.961,7.925C1.96,7.94,1.96,7.954,1.96,7.97c0,1.71,1.237,3.138,2.877,3.462c-0.301,0.08-0.617,0.123-0.945,0.123c-0.23,0-0.456-0.021-0.674-0.062c0.456,1.402,1.781,2.422,3.35,2.451c-1.228,0.947-2.773,1.512-4.454,1.512c-0.291,0-0.575-0.016-0.855-0.049c1.588,1,3.473,1.586,5.498,1.586c6.598,0,10.205-5.379,10.205-10.045c0-0.153-0.003-0.305-0.01-0.456c0.7-0.499,1.308-1.12,1.789-1.827c-0.644,0.28-1.334,0.469-2.06,0.555C17.422,4.782,17.99,4.091,18.258,3.266"></path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="remind">
                        	<p>Mọi thắc mắc xin điền vào mẫu liên hệ phía dưới</p>
                        </div>
                        <div class="form-contact">
                        	<!-- <form action="{{ url('contact') }}" method="POST">
				                { csrf_field() }
				            </form> -->
				            <b-form @submit.stop.revent="handleSubmitFormContact">
				            	<b-form-group id="group-name-email"
				            	>
				            		<b-form-input id="sender-name"
				            			type="text"
				            			v-model="form.name"
				            			required
				            			placeholder="Name"
				            		></b-form-input>
				            		<b-form-input id="sender-email"
				            			type="email"
				            			v-model="form.email"
				            			required
				            			placeholder="Email"
				            		></b-form-input>
				            	</b-form-group>

				            	<b-form-group>
				            		<b-form-input id="subject"
				            			type="text"
				            			v-model="form.subject"
				            			required
				            			placeholder="Subject"
				            		></b-form-input>
				            	</b-form-group>

				            	<b-form-group>
				            		<b-form-input id="message"
				            			type="text"
				            			v-model="form.message"
				            			required
				            			placeholder="Message"
				            		></b-form-input>
				            	</b-form-group>

				            	<b-button type="submit" variant="primary">Send Mesage</b-button>
				            </b-form>
                        </div>
		            </div>
		        </div>
		    </div>
		</div>
</template>

<script>
var csrf_token = $('meta[name="csrf-token"]').attr('content');

export default {
	data: function() {
		return {
			form: {
				name: '',
				email: '',
				subject: '',
				message: ''
			}
		}
	},
	methods: {
		handleSubmitFormContact: function() {
			var request = {
                name: this.form.name,
                email: this.form.email,
                subject: this.form.subject,
                message: this.form.message,
                type: this.type,
                _token: this.token
            };

            var app = this
            axios.post('/contact', request)
        	.then(function(refs) {
        		console.log("The mail was successful");
        		window.location.replace(baseUrl);
        	})
        	.catch(function(refs) {
        		console.log(refs);
        	});
		}
	}
}
</script>