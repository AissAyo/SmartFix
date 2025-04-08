const Encore = require('@symfony/webpack-encore');
const webpack = require('webpack'); // <-- Ensure webpack is imported

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/app.js')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableSassLoader()
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.38';
    })
    .configureCssLoader((config) => {
        config.url = {
            filter: (url) => {
                return !url.includes('ui-icons') && !url.includes('16.png');
            },
        };
    })
    .addPlugin(new webpack.ProvidePlugin({
        Chart: 'chart.js',
        'chartjs-plugin-zoom': 'chartjs-plugin-zoom', // Include chartjs-plugin-zoom
    }))
    .addRule({
        test: /\.(png|jpg|jpeg|gif|ico|svg|webp)$/,
        use: [
            {
                loader: 'file-loader',
                options: {
                    name: 'img/[name].[hash:8].[ext]',
                },
            },
        ],
    });

module.exports = Encore.getWebpackConfig();
