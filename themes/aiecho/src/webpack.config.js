const path = require( 'path' );
const wpScriptsConfig = require( '@wordpress/scripts/config/webpack.config' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const plugins = wpScriptsConfig.plugins.filter( ( item ) => {
	return ! [ 'CopyPlugin', 'MiniCssExtractPlugin' ].includes(
		item.constructor.name
	);
} );

module.exports = {
	...wpScriptsConfig,
	entry: {
		frontend: [
			path.resolve( __dirname, 'js', 'frontend.tsx' ),
			path.resolve( __dirname, 'scss', 'frontend.scss' ),
		],
		editor: [
			path.resolve( __dirname, 'js', 'editor.tsx' ),
			path.resolve( __dirname, 'scss', 'editor.scss' ),
		],
	},
	output: {
		path: path.resolve( __dirname, '../build' ),
		filename: '[name]/bundle.js',
	},
	devServer: {
		devMiddleware: {
			writeToDisk: true,
		},
		allowedHosts: 'auto',
		host: 'localhost',
		port: 'auto',
		proxy: {
			'/build': {
				pathRewrite: {
					'^/build': '',
				},
			},
		},
	},
	plugins: [
		...plugins,
		new MiniCssExtractPlugin( { filename: '[name]/bundle.css' } ),
	],
};
