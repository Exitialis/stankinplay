const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */


elixir(mix => {
    mix.less('app.less')
       .webpack('app.js')
        .styles(['toastr/build/toastr.css', 'font-awesome/css/font-awesome.css'], 'public/css/vendor.css', 'node_modules')
    mix.version([
        'public/js/app.js'
    ])
})