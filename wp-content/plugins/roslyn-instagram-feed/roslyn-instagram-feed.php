<?php
/*
Plugin Name: Roslyn Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Elated Themes
Version: 2.0.2
*/
define('ROSLYN_INSTAGRAM_FEED_VERSION', '2.0.2');
define('ROSLYN_INSTAGRAM_ABS_PATH', dirname(__FILE__));
define('ROSLYN_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));

include_once 'load.php';

if ( ! function_exists( 'roslyn_instagram_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function roslyn_instagram_theme_installed() {
		return defined( 'ELATED_ROOT' );
	}
}

if(!function_exists('roslyn_instagram_feed_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function roslyn_instagram_feed_text_domain() {
        load_plugin_textdomain('roslyn-instagram-feed', false, ROSLYN_INSTAGRAM_REL_PATH.'/languages');
    }

    add_action('plugins_loaded', 'roslyn_instagram_feed_text_domain');
}