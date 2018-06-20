const path = require('path');
const ExtractTextWebpackPlugin = require('extract-text-webpack-plugin');

const extractSass = new ExtractTextWebpackPlugin('[name].bundle.css');

const config = {
    entry: "./src/js/main.js",
    mode: 'development',
    output: {
        path: path.resolve(__dirname, 'dist'),
        filename: "[name].bundle.js"
    },
    plugins: [
        extractSass
    ],
    node: {
        fs: "empty"
    },
    module: {
        rules: [
            {
                test: /\.s[ca]ss$/,
                use: extractSass.extract([
                        { loader: "css-loader" },
                        { loader: "sass-loader" },

                ]),
            },
            {
                test: /\.(jpe?g|png|gif|svg)/,
                use: [
                    {
                        loader: 'url-loader',
                        query: {
                            limit: 5000,
                            name: '[name].[hash:8].[ext]',
                        },
                    },
                    {
                        loader: 'image-webpack-loader',
                        query: {
                            mozjpeg: {
                                quality: 65,
                            },
                        },
                    },
                ],
            },
        ]
    }
};

if (process.env.NODE_ENV === 'development') {
    config.watch = true;
    config.devtool = 'source-map';
}

module.exports = config;