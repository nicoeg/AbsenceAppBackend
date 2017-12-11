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

import '../../../node_modules/vuetify/dist/vuetify.min.css'

import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuetify from 'vuetify'
import * as VueGoogleMaps from 'vue2-google-maps'

Vue.use(VueRouter)
Vue.use(Vuetify, {
    theme: {
        primary: '#006E79',
        secondary: '#b0bec5',
        accent: '#006E79',
        error: '#b71c1c'
    }
})
Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyCyGJh65QtxefTFoe9tFmWprh6EKWDwQP4'
    }
})

import ClassList from './components/ClassList.vue'
import StudentList from './components/StudentList.vue'
import Login from './components/Login.vue'

const routes = [
    { path: '/', component: ClassList, meta: { title: 'Klasser', searchable: true } },
    { path: '/students/:id', component: StudentList, meta: { title: 'Studerende' } },
]

const router = new VueRouter({
    routes
})

const app = new Vue({
    router,

    components: { Login },
    
    el: "#app",

    data: {
        drawer: false,
        searching: false,
        search: ''
    },

    methods: {
        navigateTo(to) {
            router.push(to)

            this.drawer = false
        },

        toggleSearching() {
            this.searching = !this.searching

            if (this.searching) {
                this.$nextTick(() => this.$refs.searchInput.focus())
            }
        }
    }
})