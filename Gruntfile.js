module.exports = function (grunt) {
	/**
	 *
	 * Function to return object from grunt task options stored as files in the 'grunt_options' folder.
	 *
	 */

	function loadConfig(path) {

		var glob = require('glob');
		var object = {};
		var key;

		glob.sync('*', { cwd: path }).forEach(function (option) {
			key = option.replace(/\.js$/, '');
			object[key] = require(path + option);
		});

		return object;
	}

	/**
	 *
	 * Start up config by reading from package.json.
	 *
	 */

	var dev = grunt.file.exists('local-config.json') ? grunt.file.readJSON('local-config.json') : { proxy: 'square.dev' };

	var config = {
		pkg: grunt.file.readJSON('package.json'),
		dev: dev,
	};

	/**
	 *
	 * Extend config with all the task options in /options based on the name, eg:
	 * watch.js => watch{}
	 *
	 */

	grunt.util._.extend(config, loadConfig('./grunt_options/'));

	/**
	 *
	 *  Apply config to Grunt.
	 *
	 */

	grunt.initConfig(config);

	/**
	 *
	 * Usually you would have to load each task one by one.
	 * The load grunt tasks module installed here will read the dependencies/devDependencies/peerDependencies in your package.json
	 * and load grunt tasks that match the provided patterns, eg 'grunt' below.
	 *
	 */

	require('load-grunt-tasks')(grunt);

	/**
	 *
	 * Tasks are registered here. Starts with default, which is run by simply running 'grunt' in your cli.
	 * All other use grunt + taskname.
	 *
	 */

	grunt.registerTask(
		'default', [
			'dist',
		]);

	grunt.registerTask(
		'wp-editor', [
			'postcss:themeWPEditor',
			'postcss:themeWPEditorMin',
			'header:themeWPEditor',
		]);

	grunt.registerTask(
		'wp-login', [
			'postcss:themeWPLogin',
			'postcss:themeWPLoginMin',
			'header:themeWPLogin',
		]);

	grunt.registerTask(
		'legacy', [
			'postcss:themeLegacy',
			'postcss:themeLegacyMin',
			'header:themeLegacy',
		]);

	grunt.registerTask(
		'dist', [
			'auto_install:main',
			'concurrent:preflight',
			'concurrent:dist',
		]);

	grunt.registerTask(
		'dev', [
			'auto_install:main',
			'browserSync',
			'watch',
		]);

	var target = grunt.option('target') || 'staging';
	grunt.registerTask(
		'deploy', [
			'gitcheckout:' + target,
			'gitpull:' + target,
			'gittag:' + target,
			'gitpush:tags',
			'gitpush:' + target,
			'clean:deploy',
			'copy:deploy',
			'gitadd:deploy',
			'gitcommit:deploy',
			'gitpush:server-' + target,
			'slack_notifier:' + target
		]);
};
