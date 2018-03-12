require('./bootstrap');

import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue'

Vue.use(VueRouter);
Vue.use(BootstrapVue);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

const WebsiteCrawler = Vue.component('website-crawler', require('./components/admin/WebsiteCrawler.vue'));
const ListenCategory = Vue.component('listen-category', require('./components/admin/ListenCategory.vue'));
const Audio = Vue.component('audio', require('./components/admin/Audio.vue'));

const router = new VueRouter({
	routes: [
		{
			path: '/website-crawler',
			name: 'Website Crawler',
			component: WebsiteCrawler
		},
		{
			path: '/listen/category',
			name: 'listen-category',
			component: ListenCategory
		},
		{
			path: '/listen',
			name: 'audio',
			component: Audio
		}
	]
});

const adminApp = new Vue({
	router
}).$mount('#admin-app');