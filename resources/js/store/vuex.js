import Vuex from 'vuex'
import Vue from 'vue'
Vue.use(Vuex)

import apiService from '../lib/apiServiceClass.js';
const api =  new apiService;


export default new Vuex.Store({
	strict: true,
	state: {
        today: new Date(),
        user:{},
        cards:[],
        todos:[],
        loading: false
		
	},
	mutations: {
		// Init the store with the auth user data
		SET_APP_USER: function(state,user){
			state.user = user
		},
		APP_CARDS: function(state,cards) {
			state.cards = cards;
		},
		APP_TODOS: function(state,todos) {
			state.todos = todos;
		}
		
	},
	getters: {
		today(state){
			return state.today
		},
		
	},
	actions: {
		init(context) {
			context.commit('SET_APP_USER','Fred Bennet')

			api.get('/api/cards',(status,data) => {
                context.commit('APP_CARDS', data.items)
			})
			
			api.get('/api/tasksdue',(status,data) => {
                context.commit('APP_TODOS',data.items)
            })
		},
		setAppUser(context,user){
			//console.log('rawdata',user)
			context.commit('SET_APP_USER',user)
		}

	}
})