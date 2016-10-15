
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

window.bootstrap = require('bootstrap-material-design/scripts');
$.material.init();

window.toastr = require('toastr');

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');

Vue.http.interceptors.push((request, next) => {
    next(response => {

        if (response.body.redirect)
            location.href = response.body.redirect

        if (response.body.flash) {
            window.toastr[response.body.flash.level || 'success'](response.body.flash.message)
            console.log('KEK', response.body.flash);
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
