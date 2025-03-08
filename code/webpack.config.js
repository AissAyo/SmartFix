<<<<<<< HEAD
// Assure-toi d'importer Encore correctement
const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or subdirectory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/app.js')
    .addStyleEntry('admin', './assets/scss/app.scss')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    // Exclude .css.map files from being processed
    .addRule({
        test: /\.css\.map$/,
        use: 'ignore-loader'
    })

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // configure Babel
    // .configureBabel((config) => {
    //     config.plugins.push('@babel/a-babel-plugin');
    // })

    // enables and configure @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.38';
    })

    // Ignorer les erreurs causées par les fichiers CSS manquants (comme les images)
    .configureCssLoader((config) => {
        config.url = {
            filter: (url) => {
                // Ignore les erreurs pour les fichiers spécifiques
                return !url.includes('ui-icons') && !url.includes('16.png');
            },
        };
    })

    // Exclure les fichiers source maps pour éviter l'erreur liée à bootstrap-icons.css.map
    .configureDevServerOptions((options) => {
        options.watchOptions = {
            ignored: /bootstrap-icons\.css\.map/, // Ignore ce fichier spécifique
        };
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use React
    //.enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()

    // Enable image handling
    .addRule({
        test: /\.(png|jpg|jpeg|gif|ico|svg|webp)$/,
=======
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
>>>>>>> b5f74be67730947e6fc0467d1ad111ea928ffcf3
        use: [
            {
                loader: 'file-loader',
                options: {
<<<<<<< HEAD
                    name: 'img/[name].[hash:8].[ext]',
=======
                    name: 'images/[name].[ext]', // Place les images dans public/build/images/
                    outputPath: '',  // Ne pas ajouter de sous-dossier sous public/build
                    publicPath: '/build/', // Le chemin public pour accéder aux images
>>>>>>> b5f74be67730947e6fc0467d1ad111ea928ffcf3
                },
            },
        ],
    })
<<<<<<< HEAD
;
=======

    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.38';
    })
    .copyFiles({
        from: './assets/images',
        to: 'images/[path][name].[ext]'
    });
    
>>>>>>> b5f74be67730947e6fc0467d1ad111ea928ffcf3

module.exports = Encore.getWebpackConfig();
