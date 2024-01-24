<?php

if ( ! function_exists( 'roslyn_news_add_post_carousel5_shortcodes' ) ) {
	function roslyn_news_add_post_carousel5_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'RoslynNews\CPT\Shortcodes\PostCarousel5\PostCarousel5'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'roslyn_news_filter_add_vc_shortcode', 'roslyn_news_add_post_carousel5_shortcodes' );
}

if ( ! function_exists( 'roslyn_news_set_post_carousel5_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for post carousel 5 shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function roslyn_news_set_post_carousel5_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-post-carousel5';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'roslyn_news_filter_add_vc_shortcodes_custom_icon_class', 'roslyn_news_set_post_carousel5_icon_class_name_for_vc_shortcodes' );
}