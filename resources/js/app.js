/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./custome');
window.Vue = require('vue');
window.Event = new Vue();

import Toastr from 'vue-toastr';
Vue.use(Toastr);

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('attach-to-product', require('./components/AttachToProduct.vue').default);
Vue.component('file-system', require('./components/FileSystem.vue').default);
Vue.component('avatar-profile', require('./components/Avatar.vue').default);
Vue.component('sub-product-image', require('./components/SubProductImage.vue').default);
Vue.component('products-sub-products', require('./components/ProductsSubProducts.vue').default);

const app = new Vue({
    el: '#app',
    data() {
        return {
            active: false,
        }
    },
});



