import axios from 'axios';

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

axios.interceptors.request.use(function(config){
    config.headers['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    return config;
});

axios.interceptors.response.use(response => {

    if (response.data.redirect) {
        location.href = response.data.redirect;
    }

    if (response.data.flash) {
        window.toastr[response.data.flash.level || 'success'](response.data.flash.message)
    }

    if (response.status === 429) {
        window.toastr.error('Too Many Attempts.');
    }


    return response;
});

window.axios = axios;

window.Vue = require('vue/dist/vue.js');

Vue.prototype.$http = axios;

window.bootstrap = require('bootstrap-material-design/scripts');
$.material.init();

window.toastr = require('toastr');
window.select2 = require('select2');