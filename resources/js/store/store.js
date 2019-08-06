import Vue from 'vue'
import Vuex from 'vuex'


import users from './modules/users'
import orders from './modules/orders'
import products from './modules/products'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        users,
        orders,
        products
    }
});