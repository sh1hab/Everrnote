import {createStore} from "vuex";

import axios from "axios";

const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem('TOKEN')
        }
    },
    getters: {},
    actions: {
        register({commit}, user) {
            return fetch(`http://localhost:8000/api/v1/auth/register`, {
                headers: {
                    "Content-type": "application/json",
                    Accept: "application/json",
                    "Access-Control-Allow-Origin": 'localhost'
                },
                method: "POST",
                mode: "cors",
                body: JSON.stringify(user)
            }).then((res)=> res.json())
                .then(res => {
                    commit('setUser', res);
                    return res;
                })
        }
    },
    mutations: {
        logout: state => {
            state.user.data = {};
            state.user.token = null;
        },
        setUser(state, response) {
            state.user.data = response.user;
            state.user.token = response.token;
            sessionStorage.setItem('TOKEN', response.token);
        }
    },
    modules: {}
});

export default store;



