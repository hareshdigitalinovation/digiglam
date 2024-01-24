<?php

if ( ! function_exists( 'roslyn_news_load_widgets' ) ) {
	/**
	 * Loades all widgets by going through all folders that are placed directly in widgets folder
	 * and loads load.php file in each. Hooks to roslyn_elated_after_options_map action
	 */
	function roslyn_news_load_widgets() {
		
		foreach ( glob( ROSLYN_NEWS_SHORTCODES_PATH . '/*/widget/load.php' ) as $widget_load ) {
			include_once $widget_load;
		}
		
		foreach ( glob( ROSLYN_NEWS_WIDGETS_PATH . '/*/load.php' ) as $widget_load ) {
			include_once $widget_load;
		}
	}
	
	add_action( 'roslyn_elated_before_options_map', 'roslyn_news_load_widgets', 25 );
}

if ( ! function_exists( 'roslyn_news_register_widgets' ) ) {
	function roslyn_news_register_widgets() {
		$widgets = apply_filters( 'roslyn_news_filter_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'roslyn_news_register_widgets' );
}