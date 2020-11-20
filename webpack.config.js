//https://dev.to/pixelgoo/how-to-configure-webpack-from-scratch-for-a-basic-website-46a5
// https://carrieforde.com/webpack-wordpress/
const path = require("path"),
  webpack = require("webpack"),
  MiniCssExtractPlugin = require("mini-css-extract-plugin"),
  BrowserSyncPlugin = require('browser-sync-webpack-plugin'),
  FileManagerPlugin = require("filemanager-webpack-plugin");

module.exports = [{
  name: "site",
  entry: ["./assets/src/js/site.js", "./assets/src/scss/theme.scss"],
  output: {
    path: path.resolve(__dirname, "assets/dist"),
    filename: "js/min/wps-prime.min.js",
    publicPath: "./assets/dist/"
  },
  module: {
    rules: [{
      test: /\.js$/,
      exclude: /(node_modules)/,
      use: {
        loader: "babel-loader",
        options: {
          presets: ["@babel/preset-env"]
        }
      }
    },
    {
      // Apply rule for .sass, .scss or .css files
      test: /\.(sa|sc|c)ss$/,
      // Set loaders to transform files.
      // Loaders are applying from right to left(!)
      // The first loader will be applied after others
      use: [
        {
          // After all CSS loaders we use plugin to do his work.
          // It gets all transformed CSS and extracts it into separate
          // single bundled file
          loader: MiniCssExtractPlugin.loader
        },
        {
          // This loader resolves url() and @imports inside CSS
          loader: "css-loader"
        },
        {
          // Then we apply postCSS fixes like autoprefixer and minifying
          loader: "postcss-loader"
        },
        {
          // First we transform SASS to standard CSS
          loader: "sass-loader",
          options: {
            implementation: require("sass")
          }
        }
      ]
    },
    {
      test: /\.(png|jpe?g|gif|svg)$/i,
      use: [
        {
          loader: "file-loader",
          options: {
            name: "[name].[ext]",
            outputPath: "images"
          }
        }
      ]
    }
  ]
  },
  plugins: [
    new webpack.DefinePlugin({
      ENV: JSON.stringify("site")
    }),
    new MiniCssExtractPlugin({
      filename: "css/theme.css"
    }),
    new FileManagerPlugin({
      onEnd: {
        copy: [
          {
            source: "./assets/dist/css/theme.css",
            destination: "./style.css"
          }
        ]
      }
    }),
    new BrowserSyncPlugin({
      files: '**/*.php',
      proxy: 'https://wpsg.local/',
      port: 3000,
    })
  ]
}, {
  name: "customizer",
  // Path to your entry point. From this file Webpack will begin his work
  entry: ["./assets/src/js/customizer.js"],
  output: {
    path: path.resolve(__dirname, "assets/dist"),
    filename: "js/min/wps-prime-customizer.min.js",
    publicPath: "./assets/dist/"
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules)/,
        use: {
          loader: "babel-loader",
          options: {
            presets: ["@babel/preset-env"]
          }
        }
      }
    ]
  },
  plugins: [
    new webpack.DefinePlugin({
      ENV: JSON.stringify("customizer")
    })
  ]
}, {
  name: "woocommerce",
  // Path to your entry point. From this file Webpack will begin his work
  entry: ["./assets/src/js/woocommerce.js", "./assets/src/scss/woocommerce.scss"],
  output: {
    path: path.resolve(__dirname, "assets/dist"),
    filename: "js/min/wps-woocommerce.min.js",
    publicPath: "./assets/dist/"
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env']
          }
        }
      },
      {
        // Apply rule for .sass, .scss or .css files
        test: /\.(sa|sc|c)ss$/,
        // Set loaders to transform files.
        // Loaders are applying from right to left(!)
        // The first loader will be applied after others
        use: [
          {
            // After all CSS loaders we use plugin to do his work.
            // It gets all transformed CSS and extracts it into separate
            // single bundled file
            loader: MiniCssExtractPlugin.loader
          },
          {
            // This loader resolves url() and @imports inside CSS
            loader: "css-loader",
          },
          {
            // Then we apply postCSS fixes like autoprefixer and minifying
            loader: "postcss-loader",
            options: {
              relative: true,
              //baseUrl: 'wp-content/themes/wps-alagna/'
            }
          },
          {
            // First we transform SASS to standard CSS
            loader: "sass-loader",
            options: {
              implementation: require("sass")
            }
          }

        ]
      },
      //{
      //    test: /\.svg$/,
      //    loader: 'svg-inline-loader'
      //},
      {
        test: /\.(png|jpe?g|gif|svg)$/i,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              outputPath: 'images',
            },
          },
        ],
      },
      {
        test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
        use: [{
          loader: "file-loader",
          options: {
            name: "[name].[ext]",
            outputPath: "fonts"
          }
        }]
      }
    ]
  },
  plugins: [
    new webpack.DefinePlugin({
      ENV: JSON.stringify("woocommerce")
    }),
    new MiniCssExtractPlugin({
      filename: "css/wps-woocommerce.css"
    }),
    new FileManagerPlugin({
      onEnd: {
        copy: [
          { source: './assets/dist/css/wps-woocommerce.css', destination: './wps-woocommerce.css' }
        ]
      }
    }),
    //new BrowserSyncPlugin({
    //  files: '**/*.php',
    //  proxy: 'https://wpsg.local/shop/',
    //  port: 3002,
    //})
  ]
}];