const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/assets/js')
    .styles([
        'resources/css/fonts.css',
        'resources/css/basic.css',
        'resources/css/extra.css',
    ], 'public/assets/css/app.css')
    .sass('resources/css/admin.sass', 'public/assets/css')
    .extract()
    .version();
