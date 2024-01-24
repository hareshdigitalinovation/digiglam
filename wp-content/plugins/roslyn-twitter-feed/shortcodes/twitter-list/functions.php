<?php

if ( ! function_exists( 'roslyn_twitter_add_twitter_list_shortcodes' ) ) {
	function roslyn_twitter_add_twitter_list_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'RoslynTwitter\Shortcodes\TwitterList\TwitterList'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'roslyn_twitter_filter_add_vc_shortcode', 'roslyn_twitter_add_twitter_list_shortcodes' );
}

if ( ! function_exists( 'roslyn_twitter_set_twitter_list_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for twitter list shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function roslyn_twitter_set_twitter_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-twitter-list';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'roslyn_core_filter_add_vc_shortcodes_custom_icon_class', 'roslyn_twitter_set_twitter_list_icon_class_name_for_vc_shortcodes' );
}