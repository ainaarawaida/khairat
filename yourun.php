<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              yourun
 * @since             1.0.0
 * @package           Yourun
 *
 * @wordpress-plugin
 * Plugin Name:       yourun
 * Plugin URI:        yourun
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            yourun
 * Author URI:        yourun
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       yourun
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'YOURUN_VERSION', '1.0.0' );
define( 'YOURUN_PATH', plugin_dir_path( __FILE__ ) );
define( 'YOURUN_URL', plugins_url('yourun') );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-yourun-activator.php
 */
function activate_yourun() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-yourun-activator.php';
	Yourun_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-yourun-deactivator.php
 */
function deactivate_yourun() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-yourun-deactivator.php';
	Yourun_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_yourun' );
register_deactivation_hook( __FILE__, 'deactivate_yourun' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-yourun.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_yourun() {

	$plugin = new Yourun();
	$plugin->run();

}
run_yourun();



function deb($data){
	print_r("<pre>");
	print_r($data);
}

