/**
 * Created by francy on 3/7/18.
 */

require('./bootstrap');

Vue.component('website-crawler', require('./components/admin/WebsiteCrawler.vue'));

// const admin = new Vue({
//    el: '#crawler-tool'
// });

const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }

const routes = [
   { path: '/foo', component: Foo },
   { path: '/bar', component: Bar }
]

const router = new VueRouter({
   routes
})

const admin = new Vue({
   router
}).$mount('#crawler-tool')
