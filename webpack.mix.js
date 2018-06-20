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

mix.styles([
    'public/template/font-awesome/css/font-awesome.css',
    'public/template/Roboto.css',
    'public/template/normalize.css',
    'public/template/plugins/bootstrap/css/bootstrap.min.css',
    'public/template/plugins/bootstrap-select/dist/css/bootstrap-select.min.css',
    'public/template/plugins/animate.css-master/animate.min.css',
    'public/template/plugins/jquery-ui-1.11.4.custom/jquery-ui.min.css',
    'public/template/plugins/tooltipster-master/dist/css/tooltipster.bundle.min.css',
    'public/template/plugins/tooltipster-master/dist/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-borderless.min.css',
    'public/template/plugins/owl.carousel.2/assets/owl.carousel.css',
    'public/template/header.css',
    'public/template/style.css'
], 'public/css/app.css').version();

mix.scripts([
    'public/template/plugins/jquery-ui-1.11.4.custom/jquery-ui.min.js',
    'public/template/plugins/waitsync/waitsync.min.js',
    'public/template/plugins/owl.carousel.2/owl.carousel.min.js',
    'public/template/plugins/jquery-match-height-master/jquery.matchHeight.min.js',
    'public/template/plugins/tooltipster-master/dist/js/tooltipster.bundle.min.js',
    'public/template/plugins/prettyphoto-master/js/jquery.prettyPhoto.min.js',
    'public/template/plugins/bootstrap-select/dist/js/bootstrap-select.min.js',
    'public/template/plugins/bootstrap/js/bootstrap.min.js',
    'public/template/js/jclient.validation.js',
    'public/template/js/launch.js',
    'public/template/js/theme.js',
    'public/template/js/header.js',
    'public/template/js/main.js'
], 'public/js/custom.js').version();

mix.js('resources/assets/js/app.js', 'js').version();
