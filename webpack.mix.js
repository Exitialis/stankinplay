const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js/app.js').version();

mix.less('resources/assets/less/app.less', 'public/css/app.css');

mix.styles(['toastr/build/toastr.css', 'font-awesome/css/font-awesome.css'], 'public/css/vendor.css')
    .copy('node_modules/font-awesome/fonts/*', 'public/fonts');



