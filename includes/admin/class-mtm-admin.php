<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Maintenance Mode with Timer
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Mtm_Admin {

	function __construct() {

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'mtm_register_menu') );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this, 'mtm_register_settings') );

		// Action to Maintenance Mode
		add_action( 'wp_loaded', array($this,'mtm_maintenance_mode'), 5);
	}

	/**
	 * Function to register admin menus
	 * 
	 * @since 1.0.0
	 */
	function mtm_register_menu() {
		add_menu_page(__('Maintenance Mode - WPOS', 'maintenance-mode-with-timer'), __('Maintenance Mode - WPOS', 'maintenance-mode-with-timer'), 'manage_options', 'mtm-settings', array($this, 'mtm_main_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @since 1.0.0
	 */
	function mtm_main_page() {
		include_once( MTM_DIR . '/includes/admin/settings/mtm-pro-settings.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @since 1.0.0
	 */
	function mtm_register_settings() {

		// Reset default settings
		if( ! empty( $_POST['mtm_reset_settings'] ) && check_admin_referer( 'mtm_reset_settings', 'mtm_reset_sett_nonce' ) ) {

			// Default Settings
			mtm_set_default_settings();
		}

		// Register Setting
		register_setting( 'mtm_plugin_options', 'mtm_options', array($this, 'mtm_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @since 1.0.0
	 */
	function mtm_validate_options( $input ) {

		//general options
		$input['is_maintenance_mode']   			= !empty($input['is_maintenance_mode']) 				? 1 																: 0;
		$input['maintenance_mode_company_logo']		= isset($input['maintenance_mode_company_logo']) 		? mtm_clean_url($input['maintenance_mode_company_logo']) 			: '';
		$input['maintenance_mode_company_logo_width'] = isset($input['maintenance_mode_company_logo_width']) ? mtm_clean_number($input['maintenance_mode_company_logo_width'])	: '';
		$input['maintenance_mode_title'] 			= isset($input['maintenance_mode_title']) 				? mtm_clean($input['maintenance_mode_title']) 						: '';
		$input['maintenance_mode_text'] 			= isset($input['maintenance_mode_text']) 				? mtm_clean_html($input['maintenance_mode_text']) 					: '';

		// timer options
		$input['maintenance_mode_expire_time']	= isset($input['maintenance_mode_expire_time'])	? mtm_clean_html($input['maintenance_mode_expire_time'])	: '';

		//social options
		$input['mtm_facebook'] 		= isset($input['mtm_facebook'])		? mtm_clean_url($input['mtm_facebook'])		: '';
		$input['mtm_twitter'] 		= isset($input['mtm_twitter'])		? mtm_clean_url($input['mtm_twitter'])		: '';
		$input['mtm_linkedin'] 		= isset($input['mtm_linkedin'])		? mtm_clean_url($input['mtm_linkedin'])		: '';
		$input['mtm_github'] 		= isset($input['mtm_github'])		? mtm_clean_url($input['mtm_github'])		: '';
		$input['mtm_youtube'] 		= isset($input['mtm_youtube'])		? mtm_clean_url($input['mtm_youtube'])		: '';
		$input['mtm_pinterest'] 	= isset($input['mtm_pinterest'])	? mtm_clean_url($input['mtm_pinterest'])	: '';
		$input['mtm_instagram'] 	= isset($input['mtm_instagram'])	? mtm_clean_url($input['mtm_instagram'])	: '';
		$input['mtm_email'] 		= isset($input['mtm_email'])		? mtm_check_email($input['mtm_email'])		: '';
		$input['mtm_google_plus']	= isset($input['mtm_google_plus'])	? mtm_clean_url($input['mtm_google_plus'])	: '';
		$input['mtm_tumblr'] 		= isset($input['mtm_tumblr'])		? mtm_clean_url($input['mtm_tumblr'])		: '';

		return $input;
	}

	/**
	* Function to add maintenance file
	* 
	* @since 1.0.0
	*/
	function mtm_maintenance_mode() {

	    global $pagenow, $mtm_options;

	    $maintenance 			= mtm_get_option('is_maintenance_mode');

		$mtm_date 				= mtm_get_option('maintenance_mode_expire_time');

		// Creating compitible date according to UTF GMT time zone formate for older browwser
		$unique 				= mtm_get_unique();
		$mtm_date 				= date('F d, Y H:i:s', strtotime($mtm_date));

		$mtm_company_logo 		= mtm_get_option('maintenance_mode_company_logo');
		$mtm_company_logo_width = mtm_get_option('maintenance_mode_company_logo_width');
		$mtm_company_logo_width = (!empty($mtm_company_logo_width)) ? "style='width:".esc_attr($mtm_company_logo_width)."px'" : 'style="width:250px;"' ;
		$mtm_title 				= mtm_get_option('maintenance_mode_title');
		$mtm_content 			= mtm_get_option('maintenance_mode_text');

		$mtm_bgtimer 			= mtm_get_option('maintenance_mode_expire_time');

		$mtm_facebook 			= mtm_get_option('mtm_facebook');
		$mtm_twitter 			= mtm_get_option('mtm_twitter');
		$mtm_linkedin 			= mtm_get_option('mtm_linkedin');
		$mtm_github 			= mtm_get_option('mtm_github');
		$mtm_youtube 			= mtm_get_option('mtm_youtube');
		$mtm_pinterest 			= mtm_get_option('mtm_pinterest');
		$mtm_instagram 			= mtm_get_option('mtm_instagram');
		$mtm_email 				= mtm_get_option('mtm_email');
		$mtm_google_plus 		= mtm_get_option('mtm_google_plus');
		$mtm_tumblr				= mtm_get_option('mtm_tumblr');

		// Compacting Variables
		$date_conf 	= compact('mtm_date');

	    if( ! empty( $maintenance ) && $pagenow !== 'wp-login.php' && !is_user_logged_in() ) {
	        require_once( MTM_DIR . '/templates/maintenance-template.php' );
	        die();
	    }
	}
}

$mtm_admin = new Mtm_Admin();