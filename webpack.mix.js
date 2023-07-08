const mix = require("laravel-mix");
const sass = require("sass");

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

mix.js("resources/js/app.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [
        //
    ])
    .copy("node_modules/cropperjs/dist/cropper.css", "public/css")
    .copy("node_modules/cropperjs/dist/cropper.js", "public/js")
    .sass(
        "resources/sass/app.scss",
        "public/css",
        {},
        { implementation: sass }
    );
