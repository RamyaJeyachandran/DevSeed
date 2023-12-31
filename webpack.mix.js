const mix = require("laravel-mix");

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
 
mix.js("public/src/js/app.js", "dist/js")
    .js("public/src/js/ckeditor-classic.js", "public/dist/js")
    .js("public/src/js/ckeditor-inline.js", "public/dist/js")
    .js("public/src/js/ckeditor-balloon.js", "public/dist/js")
    .js("public/src/js/ckeditor-balloon-block.js", "public/dist/js")
    .js("public/src/js/ckeditor-document.js", "public/dist/js")
    .js('public/src/js/patient.js', 'public/dist/js/patient.js')
    .css("public/dist/css/_app.css", "public/dist/css/app.css")
    .options({
        processCssUrls: false,
    })
    .copyDirectory("public/src/json", "public/dist/json")
    .copyDirectory("public/src/fonts", "public/dist/js/fonts")
    .copyDirectory("public/src/images", "public/dist/images");
