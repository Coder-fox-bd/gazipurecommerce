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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css')
//     .sourceMaps();

mix.copyDirectory('resources/admin', 'public/admin');

mix.copyDirectory('resources/user/bootstrap/css', 'public/user/bootstrap/css');
mix.copyDirectory('resources/user/bootstrap/js', 'public/user/bootstrap/js');

mix.copyDirectory('resources/user/css', 'public/user/css');

mix.copyDirectory('resources/user/fontawesome/css', 'public/user/fontawesome/css');
mix.copyDirectory('resources/user/fontawesome/js', 'public/user/fontawesome/js');

mix.copyDirectory('resources/user/fonts/fontawesome/css', 'public/user/fonts/fonts/fontawesome/css');

mix.copyDirectory('resources/user/images', 'public/user/images');
mix.copyDirectory('resources/user/jquery', 'public/user/jquery');
mix.copyDirectory('resources/user/js', 'public/user/js');
mix.copyDirectory('resources/toastr', 'public/toastr');