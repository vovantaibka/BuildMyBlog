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

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/admin-app.js', 'public/js/admin-app.js')
   .js('resources/assets/js/vue-app.js', 'public/js/vue-app.js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/styles.scss', 'public/css/styles.css')
   .sass('resources/assets/sass/tests.scss', 'public/css/tests.css')
   .sass('resources/assets/sass/admin-styles.scss', 'public/css/admin-styles.css');