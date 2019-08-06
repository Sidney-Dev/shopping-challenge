require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'

import { routes } from './routes'

import store from './store/store'

Vue.use(VueRouter)

Vue.component('cart-component', require('./components/Cart.vue').default);

Vue.component('app-user-profile', require('./components/User/Profile.vue').default);
Vue.component('products-component', require('./components/Products/Products.vue').default);

Vue.filter('description_filter', function(value){
	return value.substr(0, 80) +'...';
})

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    el: '#app',
    router,
    store
});
