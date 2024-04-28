const path = require( 'path' );
const wpScriptsConfig = require( '@wordpress/scripts/config/webpack.config' );
const CopyPlugin = require( 'copy-webpack-plugin' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );

module.exports = () => {
	return {
		...wpScriptsConfig,
		output: {
			path: path.resolve( __dirname, '../../build/blocks' ),
		},
		devServer: {
			devMiddleware: {
				writeToDisk: true,
			},
			allowedHosts: 'auto',
			host: 'localhost',
			port: 'auto',
			proxy: {
				'/build/blocks': {
					pathRewrite: {
						'^/build/blocks': '',
					},
				},
			},
		},
		plugins: [
			...wpScriptsConfig.plugins,
			new MiniCssExtractPlugin( { filename: '[name].css' } ),
			new CopyPlugin( {
				patterns: [
					{
						from: './**/*.twig',
						context: path.resolve( __dirname, './' ),
						noErrorOnMissing: true,
					},
				],
			} ),
		],
	};
};
