import axios from 'axios'
import router from '../router/router'

export default {
    namespaced: true,

    state:{
        authenticated:false,
        user:{},
        token: null,
    },

    getters:{
        authenticated(state){
            return state.authenticated
        },

        user(state){
            return state.user
        }
    },

    mutations:{
        SET_AUTHENTICATED (state, value) {
            state.authenticated = value
        },

        SET_USER (state, value) {
            state.user = value
        },

        SET_TOKEN(state, value) {
            state.token = value
        }
    },
    
    actions:{
        async login({commit}, payload){
            commit('SET_TOKEN', payload)
            return axios.get('/api/user', {
                headers: {
                    'Authorization': `Bearer ${payload}`
                }
            }).then((data)=>{
                commit('SET_USER',data.data)
                commit('SET_AUTHENTICATED',true)
            }).catch(()=>{
                commit('SET_USER',{})
                commit('SET_AUTHENTICATED',false)
            })
        },

        authenticate({commit}, payload){
            commit('SET_AUTHENTICATED', true)
        },

        logout_store({ commit }){
            commit('SET_USER',{})
            commit('SET_AUTHENTICATED',false)
            commit('SET_TOKEN', null)
        }
    }
}