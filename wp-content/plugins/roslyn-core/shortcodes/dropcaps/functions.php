<?php

if ( ! function_exists( 'roslyn_core_add_dropcaps_shortcodes' ) ) {
	function roslyn_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'RoslynCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'roslyn_core_filter_add_vc_shortcode', 'roslyn_core_add_dropcaps_shortcodes' );
}