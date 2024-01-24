<?php

if ( ! function_exists( 'roslyn_elated_add_product_list_simple_shortcode' ) ) {
	function roslyn_elated_add_product_list_simple_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'RoslynCore\CPT\Shortcodes\ProductListSimple\ProductListSimple',
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	if ( roslyn_elated_core_plugin_installed() ) {
		add_filter( 'roslyn_core_filter_add_vc_shortcode', 'roslyn_elated_add_product_list_simple_shortcode' );
	}
}

if ( ! function_exists( 'roslyn_elated_add_product_list_simple_into_shortcodes_list' ) ) {
	function roslyn_elated_add_product_list_simple_into_shortcodes_list( $woocommerce_shortcodes ) {
		$woocommerce_shortcodes[] = 'eltdf_product_list_simple';
		
		return $woocommerce_shortcodes;
	}
	
	add_filter( 'roslyn_elated_woocommerce_shortcodes_list', 'roslyn_elated_add_product_list_simple_into_shortcodes_list' );
}