const Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const path = require('path');
<<<<<<< HEAD

// Force le bon mode avant tout
process.env.NODE_ENV = process.env.NODE_ENV || 'development';

Encore
    .setOutputPath(path.resolve(__dirname, 'public/build')) // De `SmartFix/` vers `public/build/`
    .setPublicPath('/build') // URL dans Twig
    // .enableManifest()
    .enableSourceMaps(!Encore.isProduction())
    .cleanupOutputBeforeBuild()
    .enableVersioning(Encore.isProduction())
    .enableSingleRuntimeChunk()

    // Entrées JS et CSS depuis /code/assets/
    .addEntry('app', './assets/app.js')
    .addStyleEntry('main-css', './assets/app.css')
    

    .enablePostCssLoader()
    .configureImageRule({
        type: 'asset/resource',
        filename: 'images/[name][ext]'
    })
    .configureFontRule({
        type: 'asset/resource',
        filename: 'fonts/[name][ext]'
    })
    // .addPlugin(new CopyWebpackPlugin({
    //     patterns: [
    //         {
    //             from: './node_modules/jquery-ui-dist/images',
    //             to: 'images/[name][ext]'
    //         },
    //         {
    //             from: './node_modules/bootstrap-icons/font/fonts',
    //             to: 'fonts/[name][ext]',
    //             noErrorOnMissing: true
    //         },
    //         {
    //             from: './assets/img',
    //             to: 'img/[name][ext]',
    //             noErrorOnMissing: true
    //         },
    //         {
    //             from: './assets/images',
    //             to: 'images/[name][ext]',
    //             noErrorOnMissing: true
    //         }
    //     ]
    // }));

const config = Encore.getWebpackConfig();

config.resolve.alias = {
    'jquery-ui': 'jquery-ui-dist/jquery-ui.js',
    '../img': path.resolve(__dirname, 'code/assets/img'),
    '../images': path.resolve(__dirname, 'code/assets/images')
};

config.mode = process.env.NODE_ENV === 'production' ? 'production' : 'development';

module.exports = config;
=======
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
>>>>>>> d331f346cd04f3378b0a8818d61b041afc32c544
