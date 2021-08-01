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

//Import VueProgressBar
import VueProgressBar from 'vue-progressbar'

//Import Sweetalert2
import Swal from 'sweetalert2'
// for global declaration i.e its accessble anywhere in the application
window.swal = Swal;


// sweetalert2 toaster importation
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

//global Toast to be accessable any where in the application
window.toast = Toast; //window.toast is use to access the the toast anywhere in the application

//global Fire Vue for reloading from the database
window.Fire = new Vue();

// vue progress bar here
const options = {
  color: '#bffaf3',
  failedColor: '#874b4b',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  },
  autoRevert: true,
  location: 'top',
  inverse: false
}

// Telling the vue we want to use vueProgressbar
Vue.use(VueProgressBar, options)

// vform build in  components
Vue.component(AlertSuccess.name, AlertSuccess)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
Vue.component(HasError.name, HasError)
// Telling vue we want use VueRouter
Vue.use(VueRouter) 
Vue.use(Vuetify) 

let routes = [
 { path: '/users',    component: require('./components/Users.vue').default },
 { path: '/country',  component: require('./components/Country.vue').default },
 { path: '/state', component: require('./components/State.vue').default },
 { path: '/city', component: require('./components/City.vue').default },
 { path: '/department', component: require('./components/Department.vue').default },
 { path: '/employee_create', name: "EmployeeCreate", component: require('./components/Employee/Create.vue').default },
 { path: '/home', component: require('./components/Employee/Index.vue').default }
  
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
// Vue.component('employee', require('./components/Employee/Index.vue').default);

const app = new Vue({
    el: '#app',
    vuetify,
    router
});