
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VueRouter from 'vue-router'
import BootstrapVue from 'bootstrap-vue'

Vue.use(VueRouter);
Vue.use(BootstrapVue);

import 'bootstrap-vue/dist/bootstrap-vue.css'

const HomePage = Vue.component('home-page', require('./components/HomePage.vue'));
const BlogPage = Vue.component('blog-page', require('./components/BlogPage.vue'));
const AboutPage = Vue.component('about-page', require('./components/AboutPage.vue'));
const ListenEnglishPage = Vue.component('listen-page', require('./components/ListenEnglishPage.vue'));

const router = new VueRouter({
	routes: [
		{
			path: '/home',
			name: 'home-page',
			component: HomePage
		},
		{
			path: '/blog',
			name: 'blog-page',
			component: BlogPage
		},
		{
			path: '/listen-english',
			name: 'listen-page',
			component: ListenEnglishPage
		},
		{
			path: '/about',
			name: 'about-page',
			component: AboutPage
		}
	]
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
	router
}).$mount('#app');

