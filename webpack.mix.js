const { mix } = require('laravel-mix');
const exec = require('child_process').exec;
const notifier = require('node-notifier');
const path = require('path');

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

mix.webpackConfig({
    plugins: [
        new mix.plugins.BrowserSyncPlugin(Object.assign({
            host: 'localhost',
            port: 3000,
            proxy: 'stankinplay.dev',
            files: [{
                match: [
                    'app/**/*.php',
                    'routes/**/*.php',
                    // '_legacy/**/*.php',
                    'resources/views/**/*.php',
                    'public/mix-manifest.json',
                    'public/css/**/*.css',
                    'public/js/**/*.js'
                ],
                fn: function(event, file) {
                    const browserSync = require("browser-sync").get('bs-webpack-plugin');
                    if (event === 'change') {
                        browserSync.reload();
                        if (process.env.NODE_ENV === 'testing') {
                            exec('php vendor/bin/phpunit', (error, stdout, stderr) => {
                                if (error) {
                                    notifier.notify({
                                        title: 'PhpUnit',
                                        message: 'Tests was failed',
                                        icon: path.join(__dirname, 'phpunit.png'),
                                    })
                                } else {
                                    notifier.notify({
                                        title: 'PhpUnit',
                                        message: 'Tests successfully passed',
                                        icon: path.join(__dirname, 'phpunit.png'),
                                    })
                                }
                                console.log(`${stdout}`);
                                console.log(`${stderr}`);
                            })
                        }
                    }
                }
            }]
        }, {name: "bs-webpack-plugin"}))
    ]
});
