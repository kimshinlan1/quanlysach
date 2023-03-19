const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css");
mix.styles(['resources/assets/css/styles.css'], 'public/assets/css/styles.css');
mix.styles(['resources/assets/css/app.css'], 'public/assets/css/app.css');
mix.js(['resources/assets/js/index.js'], 'public/assets/js/index.js');
mix.js(['resources/assets/js/app.js'], 'public/assets/js/app.js');
