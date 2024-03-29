const mix = require('laravel-mix');

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

mix.js(["resources/js/package.js",'resources/js/app.js'], 'js/app.js').extract([
    // Extract packages from node_modules to vendor.js
    'jquery'
])
   .sass('resources/sass/app.scss', 'public/css');
