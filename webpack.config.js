const webpack = require('webpack');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')
const path = require('path');

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
    // new webpack.ProvidePlugin({
    //  $: "jquery",
    //  jQuery: "jquery"
    // })
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
