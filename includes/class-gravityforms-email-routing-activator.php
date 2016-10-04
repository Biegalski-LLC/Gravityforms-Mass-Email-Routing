<?php

/**
 * Fired during plugin activation
 *
 * @link       https://biegal.ski/
 * @since      0.0.1
 *
 * @package    Gravityforms_Email_Routing
 * @subpackage Gravityforms_Email_Routing/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      0.0.1
 * @package    Gravityforms_Email_Routing
 * @subpackage Gravityforms_Email_Routing/includes
 * @author     Michael <michael@biegalski-llc.com>
 */
class Gravityforms_Email_Routing_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    0.0.1
	 */
	public static function activate() {
        global $wpdb;

        $table_name = $wpdb->prefix.'rg_email_routing';

        if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
                              id mediumint(9) NOT NULL AUTO_INCREMENT,                              
                              form_id mediumint(9) DEFAULT 0,
                              field_id DOUBLE(5,1) DEFAULT 0,
                              field_value VARCHAR(255) NOT NULL,
                              email_address VARCHAR(255) NOT NULL,
                              notification_name VARCHAR(255) NOT NULL,
                              created_at timestamp,
                              updated_at timestamp,
                              UNIQUE KEY id (id)
                         ) $charset_collate;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );
        }

	}

}
