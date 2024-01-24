<?php
/*
Plugin Name: Roslyn Twitter Feed
Description: Plugin that adds Twitter feed functionality to our theme
Author: Elated Themes
Version: 1.0.2
*/

define( 'ROSLYN_TWITTER_FEED_VERSION', '1.0.2' );
define( 'ROSLYN_TWITTER_ABS_PATH', dirname( __FILE__ ) );
define( 'ROSLYN_TWITTER_REL_PATH', dirname( plugin_basename( __FILE__ ) ) );
define( 'ROSLYN_TWITTER_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'ROSLYN_TWITTER_ASSETS_PATH', ROSLYN_TWITTER_ABS_PATH . '/assets' );
define( 'ROSLYN_TWITTER_ASSETS_URL_PATH', ROSLYN_TWITTER_URL_PATH . 'assets' );
define( 'ROSLYN_TWITTER_SHORTCODES_PATH', ROSLYN_TWITTER_ABS_PATH . '/shortcodes' );
define( 'ROSLYN_TWITTER_SHORTCODES_URL_PATH', ROSLYN_TWITTER_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'roslyn_twitter_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function roslyn_twitter_theme_installed() {
		return defined( 'ELATED_ROOT' );
	}
}

if ( ! function_exists( 'roslyn_twitter_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function roslyn_twitter_feed_text_domain() {
		load_plugin_textdomain( 'roslyn-twitter-feed', false, ROSLYN_TWITTER_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'roslyn_twitter_feed_text_domain' );
}