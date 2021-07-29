require('./bootstrap');
// import Vue from 'vue'
// window.Vue = require('vue');
window.Vue = require('vue').default;
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';

// Import V-form
import Form from 'vform'
window.Form = Form;


//global Fire Vue for reloading from the database
window.Fire = new Vue();

// vform component importation
import {
  AlertError,
  AlertErrors,
  HasError,
  AlertSuccess
} from 'vform/src/components/bootstrap5'

// vform build in  components
Vue.component(AlertSuccess.name, AlertSuccess)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
Vue.component(HasError.name, HasError)
// Telling vue we want use VueRouter
Vue.use(VueRouter) 
Vue.use(Vuetify) 

let routes = [
 { path: '/users', component: require('./components/Users.vue').default },
  { path: '/country', component: require('./components/Country.vue').default }
  
  // { path: '*', component: require('./components/NotFound.vue').default }
]

//VueRouter
const router = new VueRouter({
  mode: 'history', // clearing the history of the url if vue component is called.
  routes
})


let vuetify = new Vuetify({
    theme: {
        themes: {
            light: {
                primary: '#3f51b5',
                secondary: '#696969',
                accent: '#8c9eff',
                error: '#b71c1c',
            },
        },
    },
})


Vue.component('dashboard', require('./components/Dashboard.vue').default);

const app = new Vue({
    el: '#app',
    vuetify,
    router
});