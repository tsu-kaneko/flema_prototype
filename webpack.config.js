const path = require('path');
const webpack = require('webpack');

module.exports = {
  mode: 'production', // 追加
  entry: {
    'itemList': [
      path.resolve(__dirname, 'frontend/entry/itemList.js')
    ],
    'itemDetail': [
      path.resolve(__dirname, 'frontend/entry/itemDetail.js')
    ],
    'itemCreate': [
      path.resolve(__dirname, 'frontend/entry/itemCreate.js')
    ]
  },
  output: {
    filename: '[name].bundle.js',
    path: path.resolve(__dirname, 'public/bundles'),
    // publicPath: '/'
  },
  plugins: [
    new webpack.DefinePlugin({
      'process.env.NODE_ENV': JSON.stringify(process.env.NODE_ENV)
    }),
    new webpack.ProvidePlugin({
      riot: 'riot'
    }),
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery'
    })
    // webpack.optimize.UglifyJsPluginを削除
  ],
  module: {
    rules: [
      {
        test: /\.tag$/,
        exclude: /node_modules/,
        loader: 'riotjs-loader'
      }
    ]
  },
  resolve: {
    extensions: ['.js', '.jsx'],
  },
};