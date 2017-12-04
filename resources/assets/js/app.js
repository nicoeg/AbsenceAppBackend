/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap")

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vue from 'vue'
import Vuetify from 'vuetify'

import '../../../node_modules/vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

import ClassList from './components/ClassList.vue'
import Login from './components/Login.vue'

const app = new Vue({
    components: { ClassList, Login },
    
    el: "#app"
})
