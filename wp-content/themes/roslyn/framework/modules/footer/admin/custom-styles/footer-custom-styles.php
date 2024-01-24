<?php

if ( ! function_exists( 'roslyn_elated_footer_top_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer top area
	 */
	function roslyn_elated_footer_top_general_styles() {
		$item_styles      = array();
		$background_color = roslyn_elated_options()->getOptionValue( 'footer_top_background_color' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		echo roslyn_elated_dynamic_css( '.eltdf-page-footer .eltdf-footer-top-holder', $item_styles );
	}
	
	add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_footer_top_general_styles' );
}

if ( ! function_exists( 'roslyn_elated_footer_bottom_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer bottom area
	 */
	function roslyn_elated_footer_bottom_general_styles() {
		$item_styles      = array();
		$background_color = roslyn_elated_options()->getOptionValue( 'footer_bottom_background_color' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		echo roslyn_elated_dynamic_css( '.eltdf-page-footer .eltdf-footer-bottom-holder', $item_styles );
	}
	
	add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_footer_bottom_general_styles' );
}