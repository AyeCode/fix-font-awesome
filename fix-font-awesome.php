<?php
/**
 * This is the main plugin file, here we declare and call the important stuff
 *
 * @copyright   2018 AyeCode Ltd
 * @license     GPL-2.0+
 * @since       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name: Fix Font Awesome
 * Plugin URI: https://wpgeodirectory.com/
 * Description: Tries to remove all Font Awesome versions so we can add back the latest v5 JS version only.
 * Version: 0.0.1-dev
 * Author: AyeCode
 * Author URI: https://wpgeodirectory.com
 * Text Domain: fix-font-awesome
 * Domain Path: /languages
 * Requires at least: 3.1
 * Tested up to: 4.9
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The current version number.
 *
 * @since 1.0.0
 */
define( "FIX_FONT_AWESOME_VERSION", "0.0.1-dev" );


add_action( 'plugins_loaded', 'ffa_load_textdomain' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function ffa_load_textdomain() {
	load_plugin_textdomain( 'fix-font-awesome', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}


add_filter( 'clean_url', 'ffa_remove', 99, 3 );
/**
 * Clean url.
 *
 * @since   1.0.0
 * @package GMAPIKEY
 *
 * @param string $url          Url.
 * @param string $original_url Original url.
 * @param string $_context     Context.
 *
 * @return string Modified url.
 */
function ffa_remove( $url, $original_url, $_context ) {

	if ( strstr( $url, "fontawesome" ) !== false || strstr( $url, "font-awesome" ) !== false ) {// it's a font-awesome-url
//echo $url.'###'.$_context;
		if(strstr( $url, "ffa=true" ) !== false){}
		else{
			$url = ''; // removing the url removes the file
		}

	}

	return $url;
}

function ffa_enqueue_scripts()
{
    // shims
	wp_deregister_script( 'font-awesome-shims' );
	wp_register_script( 'font-awesome-shims', 'https://use.fontawesome.com/releases/v5.3.1/js/v4-shims.js?ffa=true' );
	wp_enqueue_script( 'font-awesome-shims' );


	// FA
	wp_deregister_script( 'font-awesome' );
	wp_register_script( 'font-awesome', 'https://use.fontawesome.com/releases/v5.3.1/js/all.js?ffa=true' );
	wp_enqueue_script( 'font-awesome' );
}
add_action( 'wp_enqueue_scripts', 'ffa_enqueue_scripts' );