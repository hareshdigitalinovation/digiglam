<?php

if ( ! function_exists( 'roslyn_elated_dropdown_cart_icon_styles' ) ) {
	/**
	 * Generates styles for dropdown cart icon
	 */
	function roslyn_elated_dropdown_cart_icon_styles() {
		$icon_color       = roslyn_elated_options()->getOptionValue( 'dropdown_cart_icon_color' );
		$icon_hover_color = roslyn_elated_options()->getOptionValue( 'dropdown_cart_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo roslyn_elated_dynamic_css( '.eltdf-shopping-cart-holder .eltdf-header-cart a', array( 'color' => $icon_color ) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo roslyn_elated_dynamic_css( '.eltdf-shopping-cart-holder .eltdf-header-cart a:hover', array( 'color' => $icon_hover_color ) );
		}
	}
	
	add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_dropdown_cart_icon_styles' );
}