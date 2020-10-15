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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

// Agregando sincronozacion con el navegador
mix.browserSync('http://localhost/laravel/laravel_avanzado/public/');

// Preguntamos si se ejecuta como producccion, para que genere el versionamiento por id en el archivo mix-manifiest.json

mix.version();

