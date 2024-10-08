let mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix
    .js("src/app.js", "js/main.js")
    .js("ajax/popup-form-handler.js", "js/popup-handler.js")
    .babel("src/app.js", "js/main.js")
    .babel("ajax/popup-form-handler.js", "js/popup-handler.js")
    .sass('src/app.scss', 'css/main.css');

mix
    .browserSync({
        proxy: "http://cassie-day.local/",
        files: ["./**/*"],
});


mix.options({
    processCssUrls: false,
    postCss: [tailwindcss('./tailwind.config.js')],
    });