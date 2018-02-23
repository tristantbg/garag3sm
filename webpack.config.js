const webpack = require('webpack');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')
const ModernizrWebpackPlugin = require('modernizr-webpack-plugin')
const path = require('path');

const modernizrConfig = {
  filename: 'vendor/modernizr-bundle.js',
  'options': [
    'setClasses'
  ],
  'feature-detects': [
    "emoji",
    "history",
    "touchevents",
    "video",
    "webgl",
    "css/animations",
    "css/backgroundblendmode",
    "css/columns",
    "css/filters",
    "css/flexbox",
    "css/hyphens",
    "css/mask",
    "css/positionsticky",
    "css/scrollbars",
    "css/transforms",
    "css/transforms3d",
    "css/transitions",
    "css/vhunit",
    "css/vwunit",
    "img/srcset",
    "img/webp",
    "storage/localstorage",
    "storage/sessionstorage"
  ],
  minify: {
    output: {
      comments: false,
      beautify: false
    }
  }
}

//Get path so every environment works
const projectPath = path.resolve(__dirname);

//Define all the global config
const config = {
  entry: {
    final: projectPath + '/src/js/webpack/app.js'
  },
  output: {
    path: projectPath + '/assets/js/build/',
    filename: 'app.min.js'
  },
  plugins: [
    new UglifyJsPlugin(),
    new ModernizrWebpackPlugin(modernizrConfig)
  ],
  module: {
    loaders: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'babel-loader',
        query: {
          presets: ['babel-preset-env'].map(require.resolve),
          sourceMaps: 'inline'
        }
      }
    ]
  },
  resolve: {
    extensions: ['.js'],
    modules: [path.join(__dirname, '/node_modules')]
  }
};

module.exports = config;
