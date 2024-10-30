<?php
/**
 * Plugin generic functions file
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Get plugin default settings
 * 
 * @since 2.6.3
 */
function mtm_get_default_settings() {

    $mtm_options = array(

        // Genaral
        'is_maintenance_mode'                   => 0,
        'maintenance_mode_company_logo'         => MTM_URL.'assets/images/sample-logo.png',
        'maintenance_mode_company_logo_width'   => 250,
        'maintenance_mode_title'                => 'This Site is under construction',
        'maintenance_mode_text'                 => 'Thank you for visiting! We are currently performing scheduled maintenance and updates on the website.We will be back online to serve you in short. Thank you for your patience.',
        
        // Timer
        'maintenance_mode_expire_time'          => date( 'Y-m-d H:i:s', strtotime('+30 day', current_time('timestamp')) ),
        
        // Socials
        'mtm_facebook'                          => '',
        'mtm_twitter'                           => '',
        'mtm_linkedin'                          => '',
        'mtm_github'                            => '',
        'mtm_youtube'                           => '',
        'mtm_pinterest'                         => '',
        'mtm_instagram'                         => '',
        'mtm_email'                             => '',
        'mtm_google_plus'                       => '',
        'mtm_tumblr'                            => '',
    );

    return $mtm_options;
}

/**
 * Update default settings
 * 
 * @since 1.1.7
 */
function mtm_set_default_settings() {

    global $mtm_options;

    $mtm_options = mtm_get_default_settings();

    // Update default options
    update_option( 'mtm_options', $mtm_options );
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @since 1.1.7
 */
function mtm_get_settings() {

    $options = get_option( 'mtm_options' );

    $settings = is_array( $options ) ? $options : array();

    return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @since 1.1.7
 */
function mtm_get_option( $key = '', $default = false ) {
    
    global $mtm_options;

    $default_setting = mtm_get_default_settings();

    if( ! isset( $mtm_options[ $key ] ) && isset( $default_setting[ $key ] ) && ! $default ) {
        
        $value = $default_setting[ $key ];

    } else {

        $value = ! empty( $mtm_options[ $key ] ) ? $mtm_options[ $key ] : $default;
    }

    $value = apply_filters( 'mtm_get_option', $value, $key, $default );

    return apply_filters( 'mtm_get_option_' . $key, $value, $key, $default );
}

/**
 * Function to unique number value
 * 
 * @since 1.0.0
 */
function mtm_get_unique() {
    static $unique = 0;
    $unique++;

    return $unique;
}

/**
 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 * 
 * @since 1.0
 */
function mtm_clean( $var ) {
    if ( is_array( $var ) ) {
        return array_map( 'mtm_clean', $var );
    } else {
        $data = is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
        return wp_unslash($data);
    }
}

/**
 * Sanitize number value and return fallback value if it is blank
 * 
 * @since 1.0
 */
function mtm_clean_number( $var, $fallback = null, $type = 'int' ) {

    $var = trim( $var );
    $var = is_numeric( $var ) ? $var : 0;

    if ( $type == 'number' ) {
        $data = intval( $var );
    } else if ( $type == 'abs' ) {
        $data = abs( $var );
    } else if ( $type == 'float' ) {
        $data = (float)$var;
    } else {
        $data = absint( $var );
    }

    return ( empty( $data ) && isset( $fallback ) ) ? $fallback : $data;
}

/**
 * Sanitize URL
 * 
 * @since 1.0
 */
function mtm_clean_url( $url ) {
    return esc_url_raw( trim( $url ) );
}

/**
 * Allow Valid Html Tags
 * It will sanitize HTML (strip script and style tags)
 *
 * @since 1.0
 */
function mtm_clean_html( $data = array() ) {

    if ( is_array( $data ) ) {

        $data = array_map( 'mtm_clean_html', $data );

    } elseif ( is_string( $data ) ) {
        $data = trim( $data );
        $data = wp_filter_post_kses( $data );
    }

    return $data;
}

/**
 * Function to check email with comma separated values
 * 
 * @since 2.0
 */
function mtm_check_email( $emails ) {

    $correct_email  = array();
    $email_ids      = explode( ',', $emails );
    $email_ids      = mtm_clean( $email_ids );

    foreach ( $email_ids as $email_key => $email_value ) {
        if( is_email( $email_value ) ) {
            $correct_email[] = $email_value;
        }
    }

    return implode( ', ', $correct_email );
}