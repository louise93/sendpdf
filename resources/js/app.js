
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
var bigInt = require("big-integer");

window.$ = require('jquery');
window.JQuery = require('jquery');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('dashboard', require('./components/Dashboard.vue').default);
Vue.component('profile', require('./components/Profile.vue').default);
Vue.component('bank', require('./components/Bank.vue').default);
Vue.component('announcement', require('./components/Announcement.vue').default);
Vue.component('registration', require('./components/Registration.vue').default);
Vue.component('wallet', require('./components/Wallet.vue').default);
Vue.component('password', require('./components/Password.vue').default);
Vue.component('transpassword', require('./components/Transactionpassword.vue').default);
Vue.component('internaltransfer', require('./components/Internaltransfer.vue').default);
Vue.component('externaltransfer', require('./components/Externaltransfer.vue').default);
Vue.component('walletbalances', require('./components/Walletbalances.vue').default);
Vue.component('withdrawal', require('./components/Withdrawal.vue').default);

Vue.component('personal', require('./components/Personal.vue').default);
Vue.component('contact', require('./components/Contacts.vue').default);
Vue.component('rwallet', require('./components/Rwallet.vue').default);


import Notify from 'vue2-notify';


Vue.use(Notify,{position : 'top-right'});

import WAValidator from 'wallet-address-validator';

Vue.use(WAValidator);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
