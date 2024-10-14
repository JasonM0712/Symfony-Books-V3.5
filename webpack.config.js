const Encore = require('@symfony/webpack-encore');

Encore
    // le chemin où les fichiers compilés seront stockés
    .setOutputPath('public/build/')
    // le chemin public utilisé par le serveur web pour accéder aux fichiers
    .setPublicPath('/build')
    // ajoute l'entrée principale pour votre fichier JavaScript
    .addEntry('app', './assets/app.js')
    // divise les fichiers d'entrée pour optimiser le chargement
    .splitEntryChunks()
    // permet d'avoir un fichier runtime unique
    .enableSingleRuntimeChunk()
    // nettoyage du répertoire de sortie avant chaque build
    .cleanupOutputBeforeBuild()
    // génération de sourcemaps pour le développement
    .enableSourceMaps(!Encore.isProduction())
    // versionning des fichiers pour une meilleure mise en cache en production
    .enableVersioning(Encore.isProduction())
    // configuration de Babel pour utiliser les polyfills en fonction de l'usage
    .configureBabel(null, {
        useBuiltIns: 'usage',
        corejs: 3,
    })
    // permet de traiter les fichiers SCSS
    .enableSassLoader()
    // fournir jQuery globalement
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();