/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');

import VueTheMask from 'vue-the-mask';
Vue.use(VueTheMask);
import _ from 'lodash';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

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

require('./components/Order');

require('./components/PersonalInfo');

require('./components/ChangePassword');

require('./components/RestorePassword');

require('./components/PaymentDelivery');

require('./components/WishList');

require('./components/MyOrders');

require('./components/Review');

require('./components/Sales');

require('./components/TopProducts');

require('./components/NewProducts');

require('./components/MainSlider');

require('./components/Notify');