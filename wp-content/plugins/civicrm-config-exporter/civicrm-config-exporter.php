<?php
/**
 * Plugin Name:     CiviCRM Config Exporter
 * Plugin URI:      https://github.com/pokhiii/civicrm-config-exporter
 * Description:     Export CiviCRM configurations done from dashboard and esily import them.
 * Author:          ColoredCow
 * Author URI:      https://coloredcow.com
 * Text Domain:     civicrm-config-exporter
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Civicrm_Config_Exporter
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Set our version here.
define( 'CIVICRM_CONFIG_EXPORTER_VERSION', '0.1.0' );

// Store reference to this file.
if ( ! defined( 'CIVICRM_CONFIG_EXPORTER_FILE' ) ) {
	define( 'CIVICRM_CONFIG_EXPORTER_FILE', __FILE__ );
}

// Store URL to this plugin's directory.
if ( ! defined( 'CIVICRM_CONFIG_EXPORTER_URL' ) ) {
	define( 'CIVICRM_CONFIG_EXPORTER_URL', plugin_dir_url( CIVICRM_CONFIG_EXPORTER_FILE ) );
}

// Store PATH to this plugin's directory.
if ( ! defined( 'CIVICRM_CONFIG_EXPORTER_PATH' ) ) {
	define( 'CIVICRM_CONFIG_EXPORTER_PATH', plugin_dir_path( CIVICRM_CONFIG_EXPORTER_FILE ) );
}

/**
 * CiviCRM Config Exporter Class.
 *
 * A class that encapsulates plugin functionality.
 *
 * @since 0.1
 */
class CiviCRM_Config_Exporter {
	/**
	 * Constructor.
	 *
	 * @since 0.1
	 */
	public function __construct() {

		// Initialise.
		add_action( 'plugins_loaded', array( $this, 'initialise' ) );
	}

	/**
	 * Do stuff on plugin init.
	 *
	 * @since 0.1.0
	 */
	public function initialise() {

		// Only do this once.
		static $done;
		if ( isset( $done ) && true === $done ) {
			return;
		}

		// Bail if CiviCRM plugin is not present.
		if ( ! function_exists( 'civi_wp' ) ) {
			return;
		}

		// Bail if CiviCRM is not fully installed.
		if ( ! defined( 'CIVICRM_INSTALLED' ) ) {
			return;
		}
		if ( ! CIVICRM_INSTALLED ) {
			return;
		}

		// Include files.
		$this->include_files();

		// Finally, register hooks.
		$this->register_hooks();

		/**
		 * Broadcast that this plugin is now loaded.
		 *
		 * @since 0.3.4
		 */
		do_action( 'civicrm_config_exporter_loaded' );

		// We're done.
		$done = true;
	}

	/**
	 * Include files.
	 *
	 * @since 0.1.0
	 */
	private function include_files() {
		// Abstract classes.
		require CIVICRM_CONFIG_EXPORTER_PATH . 'includes/abstract-cce-entity-exporter.php';
		require CIVICRM_CONFIG_EXPORTER_PATH . 'includes/abstract-cce-entity-importer.php';


		// Classes.
		require CIVICRM_CONFIG_EXPORTER_PATH . 'includes/class-cce-entity-exporter-contact-type.php';
		require CIVICRM_CONFIG_EXPORTER_PATH . 'includes/class-cce-entity-exporter-custom-field.php';
		require CIVICRM_CONFIG_EXPORTER_PATH . 'includes/class-cce-entity-exporter-custom-group.php';
		require CIVICRM_CONFIG_EXPORTER_PATH . 'includes/class-cce-entity-exporter-option-group.php';
		require CIVICRM_CONFIG_EXPORTER_PATH . 'includes/class-cce-entity-importer-contact-type.php';
		require CIVICRM_CONFIG_EXPORTER_PATH . 'includes/class-cce-entity-importer-custom-field.php';
		require CIVICRM_CONFIG_EXPORTER_PATH . 'includes/class-cce-entity-importer-custom-group.php';
		require CIVICRM_CONFIG_EXPORTER_PATH . 'includes/class-cce-entity-importer-option-group.php';
	}

	/**
	 * Register hooks.
	 *
	 * If global-scope hooks are needed, add them here.
	 *
	 * @since 0.1.0
	 */
	private function register_hooks() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	public function admin_menu() {
		add_menu_page(
			'CiviCRM Config Exporter',
			'CiviCRM Exporter',
			'manage_options',
			'civicrm-config-exporter',
			array( $this, 'exporter_page' ),
			'dashicons-database',
			100
		);
	}

	public function exporter_page() {
		echo '<div class="wrap">';
		echo '<h1>CiviCRM Config Exporter</h1>';
		if ( isset( $_POST['export_civicrm_configurations'] ) ) {
			echo '<pre>';
			echo $this->export();
			echo '</pre>';
		}
		if (isset($_POST['import_civicrm_configurations'])) {
			echo '<pre>';
			echo $this->import();
			echo '</pre>';
		}
		echo '<form method="post" style="display: flex; gap: 6px;">';
		echo '<input type="submit" name="export_civicrm_configurations" value="Export All Configurations" class="button button-primary" />';
		echo '<input type="submit" name="import_civicrm_configurations" value="Import All Configurations" class="button" />';
		echo '</form>';
		echo '</div>';
	}

	public function export() {
		$messages = array();

		$custom_field_exporter = new CCE_Entity_Exporter_Custom_Field();
		$custom_group_exporter = new CCE_Entity_Exporter_Custom_Group();
		$contact_type_exporter = new CCE_Entity_Exporter_Contact_Type();
		$option_group_exporter = new CCE_Entity_Exporter_Option_Group();

		$messages[] = $option_group_exporter->run();
		$messages[] = $contact_type_exporter->run();
		$messages[] = $custom_field_exporter->run();
		$messages[] = $custom_group_exporter->run();

		return implode( "\n", $messages );
	}

	public function import() {
		$messages = [];

		$custom_group_importer = new CCE_Entity_Importer_Custom_Group();
		$custom_field_importer = new CCE_Entity_Importer_Custom_Field();
		$contact_type_importer = new CCE_Entity_Importer_Contact_Type();
		$option_group_importer = new CCE_Entity_Importer_Option_Group();

		$messages[] = $custom_group_importer->run();
		// $messages[] = $custom_field_importer->run();
		// $messages[] = $contact_type_importer->run();
		// $messages[] = $option_group_importer->run();

		return implode("\n", $messages);
	}
}

global $civicrm_config_exporter;
$civicrm_config_exporter = new CiviCRM_Config_Exporter();
