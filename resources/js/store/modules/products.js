const state = {
    products: []
}

const getters = {
    products(state){
        return state.products;
    }
}

const mutations = {
    'LIST_PRODUCTS'(state, products){
        state.products.push(...products)
    }
}

const actions = {

    //this action is used to login the user in the system
    products: ({commit}) => {
        axios.get('api/products')
        .then(res => {
            const products = res.data;
            
            commit('LIST_PRODUCTS', products)
        })
        .catch(err => console.log(err))     
    }
}

export default {
    state,
    getters,
    actions,
    mutations
};