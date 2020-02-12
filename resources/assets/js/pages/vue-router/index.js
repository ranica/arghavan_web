
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// import App from '../views/App'
import Hello from './views/hello'
import Home from './views/home'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello,
        },
    ],


});

const gate = new Vue({
    el: '#gate',
    components:{
            App
        },
    router,
});
