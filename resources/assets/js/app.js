
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
window.Vue = require('vue');

// import Vue from 'vue';
//
// import VeeValidate from 'vee-validate';
// import { Validator } from 'vee-validate';
//
// import ru from 'vee-validate/dist/locale/ru';
// import ua from 'vee-validate/dist/locale/ua';
//
// if (LANGUAGE == DEFAULT_LANGUAGE)
// {
//     Validator.localize('ru', ru);
// }
// else {
//     Validator.localize('ua', ua);
// }
//
// Vue.use(VeeValidate);


// Vue.use(VeeValidate, {
//     locale: 'ru',
//     dictionary: {
//         ru: {messages: messagesRU}
//     }
// });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


// Vue.component('example',require('./components/Example.vue'));


// require ('./components/example');

require('./components/CategoryProduct');

require('./components/ProductDetail');

require('./components/BigCart');

require('./components/MiniCart');

require('./components/Filters');

require('./components/SelectedFilters');

require('./components/SimilarProduct');

require('./components/Search');

require('./components/Register');

require('./components/Login');

require('./components/SocialEmail');