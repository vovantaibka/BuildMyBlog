require('./bootstrap');

import VueRouter from 'vue-router'
import BootstrapVue from 'bootstrap-vue'
import VueMce from 'vue-mce'

Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(VueMce);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

const PostManagement = Vue.component('post-management', require('./components/admin/PostManagement.vue')); 
const ListenCategory = Vue.component('listen-category', require('./components/admin/ListenCategory.vue'));
const ListenAudio = Vue.component('listen-audio', require('./components/admin/Audio.vue'));
const SearchCreate = Vue.component('search-create', require('./components/admin/website-crawler/SearchCreate.vue'));
const SearchIndex = Vue.component('serach-index', require('./components/admin/website-crawler/SearchIndex.vue'));
const SearchResultComment = Vue.component('search-result-comment', require('./components/admin/website-crawler/SearchResultComment.vue'));

import { component } from 'vue-mce';
const MyComponent = {
  components: {
    'vue-mce': component,
  },
};

const router = new VueRouter({
	routes: [
	{
		path: '/management/post',
		name: 'Post Management',
		component: PostManagement
	},
	{
		path: '/listen/category',
		name: 'Listen Category',
		component: ListenCategory
	},
	{
		path: '/listen/audio',
		name: 'Listen Audio',
		component: ListenAudio
	},
	{
		path: '/search-index',
		name: 'Search Index',
		component: SearchIndex
	},
	{
		path: '/search-create',
		name: 'Search Create',
		component: SearchCreate
	},
	]
});

const adminApp = new Vue({
	router
}).$mount('#admin-app');