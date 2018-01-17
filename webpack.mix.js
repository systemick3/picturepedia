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

mix.js('resources/assets/js/app.js', 'public/js')
  .scripts([
    'resources/assets/js/jquery.color.js',
    'resources/assets/js/jquery.Jcrop.js',
    'resources/assets/js/crop.js'
  ], 'public/js/crop.js')
  .version()
   .sass('resources/assets/sass/app.scss', 'public/css');
