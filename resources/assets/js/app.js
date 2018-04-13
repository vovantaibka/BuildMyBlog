
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
const ProfileUserPage = Vue.component('profile-user-page', require('./components/ProfileUserPage.vue'))

const ChatRoomPage = Vue.component('chat-room-page', require('./components/chatroom/ChatRoomPage.vue'));
const ChatMessage = Vue.component('chat-message', require('./components/chatroom/ChatMessage.vue'));
const ChatLog = Vue.component('chat-log', require('./components/chatroom/ChatLog.vue'));
const ChatComposer = Vue.component('chat-composer', require('./components/chatroom/ChatComposer.vue'));

const router = new VueRouter({
	routes: [
		{
			path: '/',
			name: 'home-page',
			component: HomePage
		},
		{
			path: '/home',
			name: 'home',
			component: HomePage,
		},
		{
			path: '/blog',
			name: 'blog',
			component: BlogPage
		},
		{
			path: '/listen-english',
			name: 'listen',
			component: ListenEnglishPage
		},
		{
			path: '/about',
			name: 'about',
			component: AboutPage
		},
		{
			path: '/chat-room',
			name: 'chat-room',
			component: ChatRoomPage
		},
		{
			path: '/profile-user/:userId',
			name: 'profile-user',
			component: ProfileUserPage
		}
	]
});

Vue.filter('getImgsUrl', function (value) {
    return imgsUrl + "/" + value;
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
	router
}).$mount('#app');

