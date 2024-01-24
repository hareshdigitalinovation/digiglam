<?php

if ( ! function_exists( 'roslyn_elated_include_blog_shortcodes' ) ) {
	function roslyn_elated_include_blog_shortcodes() {
		include_once ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/blog-list/blog-list.php';
		include_once ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/blog-slider/blog-slider.php';
	}
	
	if ( roslyn_elated_core_plugin_installed() ) {
		add_action( 'roslyn_core_action_include_shortcodes_file', 'roslyn_elated_include_blog_shortcodes' );
	}
}

if ( ! function_exists( 'roslyn_elated_add_blog_shortcodes' ) ) {
	function roslyn_elated_add_blog_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'RoslynCore\CPT\Shortcodes\BlogList\BlogList',
			'RoslynCore\CPT\Shortcodes\BlogSlider\BlogSlider'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	if ( roslyn_elated_core_plugin_installed() ) {
		add_filter( 'roslyn_core_filter_add_vc_shortcode', 'roslyn_elated_add_blog_shortcodes' );
	}
}

if ( ! function_exists( 'roslyn_elated_set_blog_list_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for blog shortcodes to set our icon for Visual Composer shortcodes panel
	 */
	function roslyn_elated_set_blog_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-blog-list';
		$shortcodes_icon_class_array[] = '.icon-wpb-blog-slider';
		
		return $shortcodes_icon_class_array;
	}
	
	if ( roslyn_elated_core_plugin_installed() ) {
		add_filter( 'roslyn_core_filter_add_vc_shortcodes_custom_icon_class', 'roslyn_elated_set_blog_list_icon_class_name_for_vc_shortcodes' );
	}
}