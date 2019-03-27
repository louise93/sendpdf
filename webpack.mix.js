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

mix.js('resources/js/app.js', 'public/js','public/Nandova/js')
   .sass('resources/sass/app.scss', 'public/css','public/Nandova/css');


// // var SWPrecacheWebpackPlugin = require('sw-precache-webpack-plugin');
// // mix.webpackConfig({
// //     plugins: [
// //     new SWPrecacheWebpackPlugin({
// //         cacheId: 'pwa',
// //         filename: 'service-worker.js',
// //         staticFileGlobs: ['public/**/*.{css,eot,svg,ttf,woff,woff2,js,html}'],
// //         minify: false,
// //         stripPrefix: 'public/',
// //         handleFetch: true,
// //         navigateFallback : '/dashboard',
// //         dynamicUrlToDependencies: { //you should add the path to your blade files here so they can be cached
// //           // '/': ['resources/views/auth/login.blade.php'],
// //           // '/login': ['resources/views/auth/login.blade.php'],
// //           // '/register': ['resources/views/auth/register.blade.php'],
// //           //'/dashboard': ['resources/views/dashboard/index.blade.php'],
// //           // '/profile/account': ['resources/views/profile/profile.blade.php'],
// //         },
// //         staticFileGlobsIgnorePatterns: [/\.map$/, /mix-manifest\.json$/, /manifest\.json$/, /service-worker\.js$/],
// //         navigateFallback: '/',
// //         runtimeCaching: [
// //             {
// //                 urlPattern: /^https:\/\/fonts\.googleapis\.com\//,
// //                 handler: 'cacheFirst'
// //             },
// //             {
// //                 urlPattern: /^https:\/\/www\.thecocktaildb\.com\/images\/media\/drink\/(\w+)\.jpg/,
// //                 handler: 'cacheFirst'
// //             }
// //         ],
// //         importScripts: ['js/offline.js']
// //     })
// //     ]
// });
