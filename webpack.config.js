
/**
 * As our first step, we'll pull in the user's webpack.mix.js
 * file. Based on what the user requests in that file,
 * a generic config object will be constructed for us.
 */

require('../src/index');
require(Mix.paths.mix());

/**
 * Just in case the user needs to hook into this point
 * in the build process, we'll make an announcement.
 */

Mix.dispatch('init', Mix);

/**
 * Now that we know which build tasks are required by the
 * user, we can dynamically create a configuration object
 * for Webpack. And that's all there is to it. Simple!
 */

let WebpackConfig = require('../src/builder/WebpackConfig');

let path = require('path');
let glob = require('glob');
let webpack = require('webpack');
let Mix = require('laravel-mix').config;
let webpackPlugins = require('laravel-mix').plugins;
let dotenv = require('dotenv');
let SWPrecacheWebpackPlugin = require('sw-precache-webpack-plugin'); //Our magic

module.exports = new WebpackConfig().build();

plugins.push(
    new SWPrecacheWebpackPlugin({
        cacheId: 'pwa',
        filename: 'service-worker.js',
        staticFileGlobs: ['public/**/*.{css,eot,svg,ttf,woff,woff2,js,html}'],
        minify: false,
        stripPrefix: 'public/',
        handleFetch: true,
        dynamicUrlToDependencies: {
          //and have full support for offline first (example below)
           '/': ['resources/views/auth/login.blade.php'],
           '/login': ['resources/views/auth/login.blade.php'],
           '/register': ['resources/views/auth/register.blade.php'],
           '/dashboard': ['resources/views/dashboard/index.blade.php'],
           '/profile/account': ['resources/views/profile/profile.blade.php'],
        },
        staticFileGlobsIgnorePatterns: [/\.map$/, /mix-manifest\.json$/, /manifest\.json$/, /service-worker\.js$/],
        runtimeCaching: [
            {
                urlPattern: /^https:\/\/fonts\.googleapis\.com\//,
                handler: 'cacheFirst'
            },
            {
                urlPattern: /^https:\/\/www\.thecocktaildb\.com\/images\/media\/drink\/(\w+)\.jpg/,
                handler: 'cacheFirst'
            }
        ],
      //  importScripts: ['./js/push_message.js']
    })
);
