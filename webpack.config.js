const Encore = require('@symfony/webpack-encore');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    .addEntry('app', './assets/app.js')

    .splitEntryChunks()
    .enableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .configureBabel(() => {}, {
        useBuiltIns: 'usage',
        corejs: 3
    })

    .enableSassLoader()

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
    })

    // Ignore source maps for CSS files
    .addLoader({
        test: /\.css$/,
        use: [
            'style-loader',
            'css-loader',
        ],
        exclude: /bootstrap-icons\.css\.map$/
    })
;

module.exports = Encore.getWebpackConfig();