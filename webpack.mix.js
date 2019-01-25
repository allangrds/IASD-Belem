const mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
    .sourceMaps();

mix.postCss(
    'resources/assets/css/app.css',
    'public/css',
)
    .options({
        postCss: [
            require('autoprefixer')(), //eslint-disable-line
            require('postcss-import')(), //eslint-disable-line
            require('postcss-css-variables')(), //eslint-disable-line
            require('cssnano')(), //eslint-disable-line
            require('postcss-cssnext')() //eslint-disable-line
        ],
    });

mix.version();
