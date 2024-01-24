<?php

if ( ! function_exists( 'roslyn_news_register_weather_widget' ) ) {
	/**
	 * Function that register weather widget
	 */
	function roslyn_news_register_weather_widget( $widgets ) {
		$widgets[] = 'RoslynNewsClassWeather';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_news_filter_register_widgets', 'roslyn_news_register_weather_widget' );
}