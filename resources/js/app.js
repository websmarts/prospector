
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



import Vue from 'vue';
import Router from 'vue-router';
import Vuetify from 'vuetify';

import store from './store/index';

import helpers from './helpers'

const plugin = {
    install () {
        Vue.helpers = helpers
        Vue.prototype.$helpers = helpers
    }
}

Vue.use(plugin)

Vue.use(Router)

Vue.use(Vuetify)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

 
const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//files.keys().map(key => console.info(key))

const App = require('./App.vue').default;

const routes = [
    { path: '/', component: files('./components/Dashboard.vue').default }
    
  ];

const router = new Router({
    routes
    
});

Vue.config.productionTip = false

// import api from './components/app/lib/apiService.js';
import apiService from './lib/apiServiceClass.js';

const api =  new apiService;

Vue.prototype.$api = api;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



const app = new Vue({
    el: '#app',
    router,
    store,
    components: { App },
    template: '<App/>',
    
    
    
});
