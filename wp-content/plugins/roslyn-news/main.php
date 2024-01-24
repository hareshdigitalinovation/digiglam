<?php
/*
Plugin Name: Roslyn News
Description: Plugin that adds news shortcodes and functionalities
Author: Elated Themes
Version: 1.0.2
*/

require_once 'load.php';

if ( ! function_exists( 'roslyn_news_activation' ) ) {
	/**
	 * Triggers when plugin is activated. It calls flush_rewrite_rules
	 * and defines roslyn_elated_news_on_activate action
	 */
	function roslyn_news_activation() {
		do_action( 'roslyn_elated_news_on_activate' );
		
		// RoslynNews\CPT\PostTypesRegister::getInstance()->register();
		flush_rewrite_rules();
	}
	
	register_activation_hook( __FILE__, 'roslyn_news_activation' );
}

if ( ! function_exists( 'roslyn_news_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function roslyn_news_text_domain() {
		load_plugin_textdomain( 'roslyn-news', false, ROSLYN_NEWS_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'roslyn_news_text_domain' );
}

if ( ! function_exists( 'roslyn_news_version_class' ) ) {
	/**
	 * Adds plugins version class to body
	 *
	 * @param $classes
	 *
	 * @return array
	 */
	function roslyn_news_version_class( $classes ) {
		$classes[] = 'eltdf-news-' . ROSLYN_NEWS_VERSION;
		
		return $classes;
	}
	
	add_filter( 'body_class', 'roslyn_news_version_class' );
}

if ( ! function_exists( 'roslyn_news_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function roslyn_news_theme_installed() {
		return defined( 'ELATED_ROOT' );
	}
}

if ( ! function_exists( 'roslyn_news_scripts' ) ) {
	/**
	 * Loads plugin scripts
	 */
	function roslyn_news_scripts() {
		$array_deps_css            = array();
		$array_deps_css_responsive = array();
		$array_deps_js             = array();
		
		if ( roslyn_news_theme_installed() ) {
			$array_deps_css[]            = 'roslyn-elated-modules';
			$array_deps_css_responsive[] = 'roslyn-elated-modules-responsive';
			$array_deps_js[]             = 'roslyn-elated-modules';
		}
		
		wp_enqueue_style( 'roslyn-news-style', plugins_url( ROSLYN_NEWS_REL_PATH . '/assets/css/news.min.css' ), $array_deps_css );
		if ( function_exists( 'roslyn_elated_is_responsive_on' ) && roslyn_elated_is_responsive_on() ) {
			wp_enqueue_style( 'roslyn-news-responsive-style', plugins_url( ROSLYN_NEWS_REL_PATH . '/assets/css/news-responsive.min.css' ), $array_deps_css_responsive );
		}
		wp_enqueue_script( 'roslyn-news-script', plugins_url( ROSLYN_NEWS_REL_PATH . '/assets/js/news.min.js' ), $array_deps_js, false, true );
	}
	
	add_action( 'wp_enqueue_scripts', 'roslyn_news_scripts' );
}

if ( ! function_exists( 'roslyn_news_style_dynamics_deps' ) ) {
	function roslyn_news_style_dynamics_deps( $deps ) {
		$style_dynamic_deps_array   = array();
		$style_dynamic_deps_array[] = 'roslyn-news-style';
		
		if ( function_exists( 'roslyn_elated_is_responsive_on' ) && roslyn_elated_is_responsive_on() ) {
			$style_dynamic_deps_array[] = 'roslyn-news-responsive-style';
		}
		
		return array_merge( $deps, $style_dynamic_deps_array );
	}
	
	add_filter( 'roslyn_elated_style_dynamic_deps', 'roslyn_news_style_dynamics_deps' );
}