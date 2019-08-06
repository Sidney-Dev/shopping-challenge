const state = {
    order: [],
    logged: '',
    order_length: 0
}

const getters = {
    order(state){
        return state.order;
    },
    order_length(state){
        return state.order_length;
    }
}

const mutations = {
    'LIST_ORDERS'(state, order){
        state.order.push(order);
    },
    'AUTHENTICATE'(state, logged){
        state.logged = logged;
    },
    'ORDER_LENGTH'(state, order_length){
        state.order_length = order_length;
    }
}

const actions = {
    list_orders: ({commit}, order) => {
        commit('LIST_ORDERS', order);
       // console.log(order);
    },

    authenticate: ({commit}, logged) => {
        commit('AUTHENTICATE', logged);
    },

    list_order_length: ({commit}, order_length) => {
        commit('ORDER_LENGTH', order_length);
    },
}

export default {
    state,
    getters,
    actions,
    mutations
};