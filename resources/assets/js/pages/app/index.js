
import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './views/app'
// import Hello from '../views/hello'
import Home from './views/home'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
                {
                    path: '/',
                    name: 'home',
                    component: Home
                },
            ],
});

const app = new Vue({
    el: '#app',
    components:{
            App
        },
    router,
});
