<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://secretstache.com/
 * @since             1.0.0
 * @package           Concatenate_Reviews
 *
 * @wordpress-plugin
 * Plugin Name:       Concatenate Reviews
 * Plugin URI:        http://secretstache.com/
 * Description:       A simple plugin that concatenates Google Reviews Pro & Yelp Revies Pro by RichPlugins
 * Version:           1.0.0
 * Author:            Secret Stache Media
 * Author URI:        http://secretstache.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cr
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently pligin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-concatenate-reviews-activator.php
 */
function activate_concatenate_reviews() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-concatenate-reviews-activator.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/class-concatenate-reviews-admin.php';
	
	Concatenate_Reviews_Activator::activate();
	Concatenate_Reviews_Admin::check_new_reviews_cb();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-concatenate-reviews-deactivator.php
 */
function deactivate_concatenate_reviews() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-concatenate-reviews-deactivator.php';
	Concatenate_Reviews_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_concatenate_reviews' );
register_deactivation_hook( __FILE__, 'deactivate_concatenate_reviews' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-concatenate-reviews.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_concatenate_reviews() {

	$plugin = new Concatenate_Reviews();
	$plugin->run();

}
run_concatenate_reviews();
