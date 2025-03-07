const Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // Entrée pour le JS du dashboard
    .addEntry('dashboard', './assets/dashboard/dashboard.js') // Entrée JS du dashboard

    // Dossier de sortie pour les fichiers compilés
    .setOutputPath('public/build/')
    .setPublicPath('/build')

    // Options de configuration
    .enableSassLoader() // Si tu utilises SCSS
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    // Configuration de Babel
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.38';
    });

module.exports = Encore.getWebpackConfig();
