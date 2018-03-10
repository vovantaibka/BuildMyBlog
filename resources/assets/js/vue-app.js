require('./bootstrap');

import VueRouter from 'vue-router';

Vue.use(VueRouter);

// const Home = Vue.component('Home', require('./components/Home.vue'));
// const Example1 = Vue.component('Example1', require('./components/Example1.vue'));

// const router = new VueRouter({
//     mode: 'history',
//     routes: [
//         {
//             path: '/vue',
//             name: 'Home',
//             component: Home
//         },
//         {
//             path: '/vue/example',
//             name: 'Example1',
//             component: Example1
//         }
//     ]
// });

// const app = new Vue({
//     el: '#app',
//     router
// });

// 1. Define route components.
// These can be imported from other files
const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }

// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
const routes = [
  { path: '/foo', component: Foo },
  { path: '/bar', component: Bar }
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  routes // short for `routes: routes`
})

// 4. Create and mount the root instance.
// Make sure to inject the router with the router option to make the
// whole app router-aware.
const app = new Vue({
  router
}).$mount('#app')

