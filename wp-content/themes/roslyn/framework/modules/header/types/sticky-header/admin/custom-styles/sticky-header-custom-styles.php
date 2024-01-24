<?php

if ( ! function_exists( 'roslyn_elated_sticky_header_styles' ) ) {
	/**
	 * Generates styles for sticky haeder
	 */
	function roslyn_elated_sticky_header_styles() {
		$background_color        = roslyn_elated_options()->getOptionValue( 'sticky_header_background_color' );
		$background_transparency = roslyn_elated_options()->getOptionValue( 'sticky_header_transparency' );
		$border_color            = roslyn_elated_options()->getOptionValue( 'sticky_header_border_color' );
		$header_height           = roslyn_elated_options()->getOptionValue( 'sticky_header_height' );
		
		if ( ! empty( $background_color ) ) {
			$header_background_color              = $background_color;
			$header_background_color_transparency = 1;
			
			if ( $background_transparency !== '' ) {
				$header_background_color_transparency = $background_transparency;
			}
			
			echo roslyn_elated_dynamic_css( '.eltdf-page-header .eltdf-sticky-header .eltdf-sticky-holder', array( 'background-color' => roslyn_elated_rgba_color( $header_background_color, $header_background_color_transparency ) ) );
		}
		
		if ( ! empty( $border_color ) ) {
			echo roslyn_elated_dynamic_css( '.eltdf-page-header .eltdf-sticky-header .eltdf-sticky-holder', array( 'border-color' => $border_color ) );
		}
		
		if ( ! empty( $header_height ) ) {
			$height = roslyn_elated_filter_px( $header_height ) . 'px';
			
			echo roslyn_elated_dynamic_css( '.eltdf-page-header .eltdf-sticky-header', array( 'height' => $height ) );
			echo roslyn_elated_dynamic_css( '.eltdf-page-header .eltdf-sticky-header .eltdf-logo-wrapper a', array( 'max-height' => $height ) );
		}
		
		$sticky_container_selector = '.eltdf-sticky-header .eltdf-sticky-holder .eltdf-vertical-align-containers';
		$sticky_container_styles   = array();
		$container_side_padding    = roslyn_elated_options()->getOptionValue( 'sticky_header_side_padding' );
		
		if ( $container_side_padding !== '' ) {
			if ( roslyn_elated_string_ends_with( $container_side_padding, 'px' ) || roslyn_elated_string_ends_with( $container_side_padding, '%' ) ) {
				$sticky_container_styles['padding-left']  = $container_side_padding;
				$sticky_container_styles['padding-right'] = $container_side_padding;
			} else {
				$sticky_container_styles['padding-left']  = roslyn_elated_filter_px( $container_side_padding ) . 'px';
				$sticky_container_styles['padding-right'] = roslyn_elated_filter_px( $container_side_padding ) . 'px';
			}
			
			echo roslyn_elated_dynamic_css( $sticky_container_selector, $sticky_container_styles );
		}
		
		// sticky menu style
		
		$menu_item_styles = roslyn_elated_get_typography_styles( 'sticky' );
		
		$menu_item_selector = array(
			'.eltdf-main-menu.eltdf-sticky-nav > ul > li > a'
		);
		
		echo roslyn_elated_dynamic_css( $menu_item_selector, $menu_item_styles );
		
		
		$hover_color = roslyn_elated_options()->getOptionValue( 'sticky_hovercolor' );
		
		$menu_item_hover_styles = array();
		if ( ! empty( $hover_color ) ) {
			$menu_item_hover_styles['color'] = $hover_color;
		}
		
		$menu_item_hover_selector = array(
			'.eltdf-main-menu.eltdf-sticky-nav > ul > li:hover > a',
			'.eltdf-main-menu.eltdf-sticky-nav > ul > li.eltdf-active-item > a'
		);
		
		echo roslyn_elated_dynamic_css( $menu_item_hover_selector, $menu_item_hover_styles );
	}
	
	add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_sticky_header_styles' );
}