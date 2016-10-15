
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

window.Vue = require('vue');
require('vue-resource');

window.toastr = require('toastr');

Vue.http.interceptors.push((request, next) => {
    request.headers['X-CSRF-TOKEN'] = Laravel.csrfToken;

    next();
});

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
