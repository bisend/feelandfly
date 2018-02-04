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

// mix.setPublicPath(path.normalize('www'));
// mix.setPublicPath('www');

mix.js('resources/assets/js/app.js', 'js').version();
   // .sass('resources/assets/sass/app.scss', 'public/css');
