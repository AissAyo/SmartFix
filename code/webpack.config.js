const Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const path = require('path');

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
