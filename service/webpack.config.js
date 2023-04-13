const Encore = require('@symfony/webpack-encore');
const webpack = require('webpack')

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/app/')
    .setPublicPath('/build/app')
    .addEntry('app', './assets/app/bootstrap.js')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableVueLoader(() => {}, { runtimeCompilerBuild: false })
    .addPlugin(new webpack.DefinePlugin({
        __VUE_OPTIONS_API__: true,
        __VUE_PROD_DEVTOOLS__: true,
    }))
    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })
    .copyFiles([
        {from: './assets/app/images', to: '../app/images/[path][name].[ext]'},
    ])
    .enableSassLoader(function(options) {}, {
        resolveUrlLoader: false
    });
const appConfig = Encore.getWebpackConfig();
appConfig.name = 'appConfig';
Encore.reset();

Encore
    .setOutputPath('public/build/dashboard/')
    .setPublicPath('/build/dashboard')
    .addEntry('dashboard', './assets/dashboard/bootstrap.js')
    .enableStimulusBridge('./assets/dashboard/controllers.json')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableVueLoader(() => {}, { runtimeCompilerBuild: false })
    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })
    .enableSassLoader();
const dashboardConfig = Encore.getWebpackConfig();
dashboardConfig.name = 'dashboardConfig';

module.exports = [appConfig, dashboardConfig];
