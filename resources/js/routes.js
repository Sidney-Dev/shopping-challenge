import Cart from './components/Cart.vue';
import Products from './components/Products/Products.vue';
import Login from './components/User/Login.vue';
import Register from './components/User/Register.vue';

export const routes = [
    { path: '/cart', component: Cart },
    { path: '/products', component: Products },
    { path: '/login', component: Login },
    { path: '/registration', component: Register },
];