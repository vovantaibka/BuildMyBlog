/**
 * Created by francy on 3/7/18.
 */

require('./bootstrap');

Vue.component('website-crawler', require('./components/admin/WebsiteCrawler.vue'));

const admin = new Vue({
   el: '#crawler-tool'
});

