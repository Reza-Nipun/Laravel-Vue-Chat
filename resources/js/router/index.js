import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

Vue.use(Loading);

import Login from '../pages/login.vue';
import Home from '../pages/home.vue';

const routes = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Login,
            name: 'login',
        },{
            path: '/home',
            component: Home,
            name: 'home',
        },
    ],
});

export default routes;