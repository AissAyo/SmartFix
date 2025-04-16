const Encore = require('@symfony/webpack-encore');

Encore
    // Set the output path for compiled assets
    .setOutputPath('public/build/')
    .setPublicPath('/build')

    // Enable source maps for easier debugging
    .enableSourceMaps(!Encore.isProduction())

    // Clean the output directory before each build
    .cleanupOutputBeforeBuild()

    // Enable versioning (hashing filenames for cache busting)
    .enableVersioning(Encore.isProduction())

    // Add CSS handling via the CSS loader and style loader
    .addEntry('app', './assets/app.js')  // Entry point for your JS

    // Enable the CSS loader automatically when you import CSS into your JavaScript
    .enablePostCssLoader()

    // Enable a single runtime chunk for better caching
    .enableSingleRuntimeChunk()

    // Add CSS files (app.css and main.css)
    .addStyleEntry('app-css', './assets/app.css')
    .addStyleEntry('main-css', './assets/css/main.css')
;

module.exports = Encore.getWebpackConfig();
