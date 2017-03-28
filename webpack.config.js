'use strict';

const path = require('path');
const loaders = require('./webpack/loaders');
const plugins = require('./webpack/plugins');


module.exports = {

  entry: {
      index: ['./resources/index.source.js']
  },

  output: {
    path: path.join(__dirname, 'resources'),
    filename: '[name].js',
    publicPath: '/',
    sourceMapFilename: '[name].js.map',
    chunkFilename: '[id].chunk.js',
    libraryTarget: "umd",
    library: "spiral-vault",
    umdNamedDefine: true
  },

  devtool: process.env.NODE_ENV === 'production' ?
    'source-map' :
    'inline-source-map',

  resolve: {
    extensions: [
      '.js',
      '.json',
      '.webpack.js',
      '.web.js',
      '.scss',
      '.css'
    ]
  },

  plugins: plugins,

  devServer: {
    historyApiFallback: {index: '/'}
  },

  module: {
    rules: [
      loaders.jsmap,
      loaders.eslint,

      loaders.js,
      loaders.css,
      loaders.sass,
      loaders.svg,
      loaders.eot,
      loaders.woff,
      loaders.woff2,
      loaders.ttf
    ]
  },
  externals: {
    "materialize-css": {
      commonjs: "materialize-css",
      commonjs2: "materialize-css"
    },
    "jquery": {
      commonjs: "jquery",
      commonjs2: "jquery",
      root: "jQuery"
    }
  }
};
