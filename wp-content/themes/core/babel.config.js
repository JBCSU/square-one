module.exports = {
	presets: [
		'@babel/preset-react',
		[
			'@babel/preset-env',
			{
				targets: {
					browsers: [
						'Chrome 60',
						'Firefox 54',
						'Safari 8',
						'ie 11',
						'Edge 14',
						'Android 4.4',
						'ios 9',
					],
				},
				useBuiltIns: 'entry',
				modules: false,
				corejs: '3.1',
			},
		],
	],
	plugins: [
		'lodash',
		[
			'module-resolver', {
				root: [ '.' ],
				alias: {
					apps: './assets/js/src/apps',
					config: './assets/js/src/theme/config',
					common: './assets/js/src/apps/common',
					components: './components',
					constants: './assets/js/src/apps/constants',
					Example: './assets/js/src/apps/Example',
					integrations: './integrations',
					pcss: './assets/css/src/theme',
					utils: './assets/js/src/utils',
				},
			},
		],
		'@babel/plugin-proposal-object-rest-spread',
		'@babel/plugin-syntax-dynamic-import',
		'@babel/plugin-transform-regenerator',
		'@babel/plugin-proposal-class-properties',
		'@babel/plugin-transform-object-assign',
	],
	env: {
		test: {
			presets: [
				[
					'@babel/preset-env',
					{
						targets: {
							browsers: [
								'Chrome 60',
								'Firefox 54',
								'Safari 8',
								'ie 11',
								'Edge 14',
								'Android 4.4',
								'ios 9',
							],
						},
						useBuiltIns: 'entry',
						modules: 'commonjs',
						corejs: '3.1',
					},
				],
			],
			plugins: [
				'istanbul',
			],
		},
	},
};
