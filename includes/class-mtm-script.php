<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Maintenance Mode with Timer
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Mtm_Script {
	
	function __construct() {
		
		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'mtm_admin_style') );
		
		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'mtm_admin_script') );
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @since 1.0.0
	 */
	function mtm_admin_style( $hook ) {
		
		// Pages array
		$pages_array = array( 'toplevel_page_mtm-settings' );

		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_array) ) {

			wp_register_style( 'wpcdt-jquery-ui-css', MTM_URL.'assets/css/mmt-time-picker.css', array(), MTM_VERSION );
			wp_enqueue_style( 'wpcdt-jquery-ui-css' );
			
			// Registring admin script
			wp_register_style( 'mtm-pro-admin-style', MTM_URL.'assets/css/mtm-pro-admin.css', array(), MTM_VERSION );
			wp_enqueue_style( 'mtm-pro-admin-style' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @since 1.0.0
	 */
	function mtm_admin_script( $hook ) {

		global $wp_version, $wp_query, $typenow;
		
		// Pages array
		$pages_array = array( 'toplevel_page_mtm-settings' );
		
		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts
		
		if( in_array($hook, $pages_array) ) {
			
			// Enqueu built-in script for color picker
			wp_enqueue_script( 'jquery-ui-datepicker' );
			wp_enqueue_script( 'jquery-ui-slider' );

			// Registring admin script
			wp_register_script( 'mtm-pro-admin-script', MTM_URL.'assets/js/mtm-pro-admin.js', array('jquery'), MTM_VERSION, true );
			wp_localize_script( 'mtm-pro-admin-script', 'MtmAdmin', array(
																	'new_ui'		=>	$new_ui,
																	'confirm_msg'	=> esc_js( __( 'Click OK to reset all options. All settings will be lost!', 'maintenance-mode-with-timer' ) ),
																));
			wp_enqueue_script( 'mtm-pro-admin-script' );
			
			// Registring admin script
			wp_register_script( 'mmt-ui-timepicker-addon-js', MTM_URL.'assets/js/mmt-ui-timepicker-addon.js', array('jquery'), MTM_VERSION, true );
			wp_enqueue_script( 'mmt-ui-timepicker-addon-js' );
			
			wp_enqueue_media(); // For media uploader
		}
	}
}

$mtm_script = new Mtm_Script();