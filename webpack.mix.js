const mix = require('laravel-mix');

mix
    .js('resources/js/app.js', 'public/assets/scripts.js')
    .sass('resources/styles/main.sass', 'public/assets/style.css');