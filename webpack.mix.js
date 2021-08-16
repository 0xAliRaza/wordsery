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

mix.js("resources/js/app.js", "public/js")
    .vue()
    .sourceMaps()

    // .postCss('resources/css/app.css', 'public/css', [
    //     require('postcss-import'),
    //     require('autoprefixer'),
    // ])
    .sass("resources/scss/app.scss", "public/css")
    .webpackConfig(require("./webpack.config"));

if (mix.inProduction()) {
    mix.version();
}

mix.browserSync("localhost:8000");
mix.disableNotifications();
