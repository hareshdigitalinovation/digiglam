<?php

if ( ! function_exists( 'roslyn_news_add_video_block2_shortcodes' ) ) {
	function roslyn_news_add_video_block2_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'RoslynNews\CPT\Shortcodes\VideoBlock2\VideoBlock2'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'roslyn_news_filter_add_vc_shortcode', 'roslyn_news_add_video_block2_shortcodes' );
}

if ( ! function_exists( 'roslyn_news_set_video_block2_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for video block 2 shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function roslyn_news_set_video_block2_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-video-block2';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'roslyn_news_filter_add_vc_shortcodes_custom_icon_class', 'roslyn_news_set_video_block2_icon_class_name_for_vc_shortcodes' );
}