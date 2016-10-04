<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://biegal.ski/
 * @since             0.0.1
 * @package           Gravityforms_Email_Routing
 *
 * @wordpress-plugin
 * Plugin Name:       Gravity Forms Email Routing
 * Plugin URI:        https://biegal.ski/plugins/gravityforms-email-routing
 * Description:       This plugin was developed for companies or users who have a massive email routing list. Rather than manually having to enter each route, just setup an excel spreadsheet and import it into the database.
 * Version:           0.0.1
 * Author:            Michael
 * Author URI:        https://biegal.ski/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gravityforms-email-routing
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gravityforms-email-routing-activator.php
 */
function activate_gravityforms_email_routing() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gravityforms-email-routing-activator.php';
	Gravityforms_Email_Routing_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gravityforms-email-routing-deactivator.php
 */
function deactivate_gravityforms_email_routing() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gravityforms-email-routing-deactivator.php';
	Gravityforms_Email_Routing_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_gravityforms_email_routing' );
register_deactivation_hook( __FILE__, 'deactivate_gravityforms_email_routing' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-gravityforms-email-routing.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.0.1
 */
function run_gravityforms_email_routing() {

	$plugin = new Gravityforms_Email_Routing();
	$plugin->run();

}
run_gravityforms_email_routing();
