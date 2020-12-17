require('./bootstrap');

window.Vue = require('vue');
Vue.use(require('vue-resource'));
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('front-page', require('./components/Front.vue').default);
Vue.component('InfiniteLoading', require('vue-infinite-loading'));

const app = new Vue({
    el: '#app',
});
