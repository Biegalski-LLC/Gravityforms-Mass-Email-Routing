<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://biegal.ski/
 * @since      0.0.1
 *
 * @package    Gravityforms_Email_Routing
 * @subpackage Gravityforms_Email_Routing/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      0.0.1
 * @package    Gravityforms_Email_Routing
 * @subpackage Gravityforms_Email_Routing/includes
 * @author     Michael <michael@biegalski-llc.com>
 */
class Gravityforms_Email_Routing_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.0.1
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'gravityforms-email-routing',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
