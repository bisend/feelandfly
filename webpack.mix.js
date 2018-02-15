let mix = require('laravel-mix');

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

// mix.styles([
//     'public/template/plugins/owl.carousel.2/assets/owl.carousel.css',
//     'public/template/plugins/prettyphoto-master/css/prettyPhoto.css',
//     'public/template/header.css',
//     'public/template/style.css',
// ], 'public/css/app.css').version();

mix.scripts([
    'public/template/js/jclient.validation.js',
    'public/template/js/launch.js',
    'public/template/js/theme.js',
    'public/template/js/header.js',
    'public/template/js/main.js',
], 'public/js/custom.js').version();

mix.js('resources/assets/js/app.js', 'js').version();
