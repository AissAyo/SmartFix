const Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const path = require('path');
const webpack = require('webpack');

Encore
    // Output and public paths
    .setOutputPath('public/build/')
    .setPublicPath('/build')

    // Enable source maps in dev
    .enableSourceMaps(!Encore.isProduction())

    // Clean before build
    .cleanupOutputBeforeBuild()

    // Enable versioning in production (you can disable this if you don't need versioning)
    .enableVersioning(Encore.isProduction())

    // Runtime chunk
    .enableSingleRuntimeChunk()

    // Entry points
    .addEntry('app', './assets/app.js')
    .addStyleEntry('main-css', './assets/css/main.css')
    .addStyleEntry('app-css', './assets/app.css')

    // Enable PostCSS
    .enablePostCssLoader()

    // Configure jQuery
    .addPlugin(new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
        'window.$': 'jquery',
    }))

    // Asset handling for images and fonts (no hashing)


    // Copy static assets (including Bootstrap Icons fonts)
    .addPlugin(new CopyWebpackPlugin({
        patterns: [
            {
                from: './node_modules/jquery-ui-dist/images',
                to: 'images/[name][ext]'
            },
            {
                from: './node_modules/bootstrap-icons/font/fonts',
                to: 'fonts/[name][ext]', // No hash in font filenames
                noErrorOnMissing: true
            },
            {
                from: './assets/img/services',
                to: 'img/services/[name][ext]',
                noErrorOnMissing: true
            },
            {
                from: './assets/img/background',
                to: 'img/background/[name][ext]',
                noErrorOnMissing: true
            },
            {
                from: './assets/img/blog',
                to: 'img/blog/[name][ext]',
                noErrorOnMissing: true
            },
            {
                from: './assets/img/client',
                to: 'img/client/[name][ext]',
                noErrorOnMissing: true
            },
            {
                from: './assets/img/landing',
                to: 'img/landing/[name][ext]',
                noErrorOnMissing: true
            },
            {
                from: './assets/img/more',
                to: 'img/more/[name][ext]',
                noErrorOnMissing: true
            },
            {
                from: './assets/img/shop',
                to: 'img/shop/[name][ext]',
                noErrorOnMissing: true
            },
            {
                from: './assets/img/slider',
                to: 'img/slider/[name][ext]',
                noErrorOnMissing: true
            },
            {
                from: './assets/img/team',
                to: 'img/team/[name][ext]',
                noErrorOnMissing: true
            },
            {
                from: './assets/img/testimonial',
                to: 'img/testimonial/[name][ext]',
                noErrorOnMissing: true
            },
            {
                from: './assets/img/clients',
                to: 'img/clients/[name][ext]',
                noErrorOnMissing: true
            },
            {
                from: './assets/img',
                to: 'img/[name][ext]',
                noErrorOnMissing: true
            }

            // {
            //     from: './assets/images/',
            //     to: 'images/[name][ext]',
            //     noErrorOnMissing: true
            // }
        ]
    }));

const config = Encore.getWebpackConfig();

// Aliases for easier import handling
config.resolve.alias = {
    'jquery-ui': 'jquery-ui-dist/jquery-ui.js',
    '../img': path.resolve(__dirname, 'assets/img'),
    '../images': path.resolve(__dirname, 'assets/images')
};

module.exports = config;