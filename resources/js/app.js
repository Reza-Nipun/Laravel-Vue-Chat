import Vue from 'vue';
import routes from './router/index';

import { HasError, AlertError } from 'vform'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

require('./bootstrap');

Vue.component('app-header', require('./components/header.vue').default);

const app = new Vue({
    el: '#app',
    router: routes,
});