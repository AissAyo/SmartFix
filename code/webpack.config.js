const Encore = require('@symfony/webpack-encore');
const path = require('path');

// Configure the runtime environment
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // Directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // Public path used by the web server to access the output path
    .setPublicPath('/build')
    
    // Entry points configuration
    .addEntry('app', './assets/app.js')
    .addEntry('main', './assets/main.js')
    .addEntry('mechanic/app', './assets/mechanic/js/app.js')
    
    // Style entries
    .addStyleEntry('styles', './assets/main.css')
    .addStyleEntry('appcss', './assets/main.css')
    .addStyleEntry('mechanic/styles', './assets/mechanic/css/app.css')

    // Basic features
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    // Configure Babel
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.38';
    })

    // Enable Sass/SCSS support
    .enableSassLoader(options => {
        options.implementation = require('sass');
        options.sassOptions = {
            outputStyle: 'compressed'
        };
    })

    // Enable PostCSS
    .enablePostCssLoader()

    // Provide jQuery globally
    .autoProvidejQuery()

    // Enable Stimulus bridge
    .enableStimulusBridge('./assets/controllers.json')

    // Configure file loader
    .configureLoaderRule('images', loaderRule => {
        loaderRule.test = /\.(png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$/;
    })
;

// Export the final configuration
module.exports = Encore.getWebpackConfig();