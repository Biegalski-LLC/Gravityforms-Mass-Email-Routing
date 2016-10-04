<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://biegal.ski/
 * @since      0.0.1
 *
 * @package    Gravityforms_Email_Routing
 * @subpackage Gravityforms_Email_Routing/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Gravityforms_Email_Routing
 * @subpackage Gravityforms_Email_Routing/admin
 * @author     Michael <michael@biegalski-llc.com>
 */
class Gravityforms_Email_Routing_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.1
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Gravityforms_Email_Routing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Gravityforms_Email_Routing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/gravityforms-email-routing-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Gravityforms_Email_Routing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Gravityforms_Email_Routing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/gravityforms-email-routing-admin.js', array( 'jquery' ), $this->version, false );

	}

    /**
     * @param $input
     * @return array
     *
     * @since    0.0.1
     */
    public function validate($input) {
        global $wpdb;

        $purlTableName = sanitize_text_field( $input['purl-table-name'] );

        $valid = array();

        if($purlTableName !== ''){

            $table_name = $wpdb->prefix.$purlTableName;

            if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

                $tableSchema = array();
                foreach ($input as $column => $value) {
                    $tableSchema[$column] = sanitize_text_field($value);
                }

                $charset_collate = $wpdb->get_charset_collate();

                $sql = "CREATE TABLE $table_name (
                              id mediumint(9) NOT NULL AUTO_INCREMENT,                              
                              form_id mediumint(9) DEFAULT 0,
                              field_id mediumint(9) DEFAULT 0,
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

        $valid['purl-table-name'] = (isset($purlTableName) && !empty($purlTableName)) ? $purlTableName : '';

        return $valid;
    }

	public function send_notification ( $event, $form, $lead ) {
        $notifications = GFCommon::get_notifications_to_send( $event, $form, $lead );
        $notifications_to_send = array();

        //running through filters that disable form submission notifications
        foreach ( $notifications as $notification ) {
            if ( apply_filters( "gform_disable_notification_{$form['id']}", apply_filters( 'gform_disable_notification', false, $notification, $form, $lead ), $notification, $form, $lead ) ) {
                //skip notifications if it has been disabled by a hook
                continue;
            }

            $notifications_to_send[] = $notification['id'];
        }

        GFCommon::send_notifications( $notifications_to_send, $form, $lead, true, $event );
    }

    /**
     * @since   0.0.1
     */
    public function options_update() {
        register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
    }

}
