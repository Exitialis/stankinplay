
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

window.Vue = require('vue/dist/vue.js');
require('vue-resource');

require('select2');

window.bootstrap = require('bootstrap-material-design/scripts');
$.material.init();

window.toastr = require('toastr');

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');

Vue.http.interceptors.push((request, next) => {
    next(response => {
        
        if (response.data.redirect)
            location.href = response.data.redirect

        if (response.data.flash) {
            window.toastr[response.data.flash.level || 'success'](response.data.flash.message)
        }
        
        if (response.status === 429)
            window.toastr.error('Too Many Attempts.')
    })
});

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
