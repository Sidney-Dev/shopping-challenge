const state = {
    users: [],
    email_reg_error: false,
    logged_user: {
        id: ''
    },
    is_logged: false,
    user: []
}

const getters = {
    users(state){
        return state.users;
    },
    
    reg_error(state){
        return state.email_reg_error;
    },
    user(state){
        return state.user;
    }
}

const mutations = {
    'FETCH_USER'(state, user){
        state.user.push(user);
    },

    'LIST_USERS'(state, users){
        state.users.push(...users)
    },
    /**
     * This mutation is used to add the active class to the the email field
     * during the registration process
     * @param {email_reg_error} state 
     */
    'EMAIL_REG_ERROR'(state){
        state.email_reg_error = true;
    },
    'AUTHENTICATED'(state){
        state.is_logged = true;
    }

}

const actions = {

    fetch_user: ({commit}, user) => {
        //console.log("Action user");
        //console.log(user);
        commit('FETCH_USER', user);
    },

    //this action is used to login the user in the system
    login: ({commit}, user) => {
        state.users.map(u => {
            if(u.email == user.email){
                //commit('AUTHENTICATED');
            }
        });        
    },

    // This actions is used to register the user
    register: ({commit}, reg_user) => {

        state.users.map(u => {
            if(u.email !== reg_user.email){
                //save the details
                console.log("Save email");
            } else {
                // email already exists
                // show error message
                console.log("Do not save email");
                commit('EMAIL_REG_ERROR');
            } 
        }); 
    }
}

export default {
    state,
    getters,
    actions,
    mutations
};