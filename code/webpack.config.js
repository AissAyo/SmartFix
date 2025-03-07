const Encore = require('@symfony/webpack-encore');

Encore
    .addEntry('dashboard', './assets/dashboard/dashboard.js')
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .enableSassLoader()
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    // Ajouter une règle pour les images
    .addRule({
        test: /\.(png|jpg|jpeg|gif|svg)$/i,
        use: [
            {
                loader: 'file-loader',
                options: {
                    name: 'images/[name].[ext]', // Place les images dans public/build/images/
                    outputPath: '',  // Ne pas ajouter de sous-dossier sous public/build
                    publicPath: '/build/', // Le chemin public pour accéder aux images
                },
            },
        ],
    })

    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.38';
    })
    .copyFiles({
        from: './assets/images',
        to: 'images/[path][name].[ext]'
    });
    

module.exports = Encore.getWebpackConfig();
