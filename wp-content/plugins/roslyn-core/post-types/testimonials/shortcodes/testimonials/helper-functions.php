<?php
if ( ! function_exists( 'roslyn_core_add_testimonials_shortcode' ) ) {
	function roslyn_core_add_testimonials_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'RoslynCore\CPT\Shortcodes\Testimonials\Testimonials'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'roslyn_core_filter_add_vc_shortcode', 'roslyn_core_add_testimonials_shortcode' );
}

if ( ! function_exists( 'roslyn_core_set_testimonials_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for testimonials shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function roslyn_core_set_testimonials_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-testimonials';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'roslyn_core_filter_add_vc_shortcodes_custom_icon_class', 'roslyn_core_set_testimonials_icon_class_name_for_vc_shortcodes' );
}