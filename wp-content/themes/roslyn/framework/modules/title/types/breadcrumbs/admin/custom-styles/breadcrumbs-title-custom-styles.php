<?php

if ( ! function_exists( 'roslyn_elated_breadcrumbs_title_area_typography_style' ) ) {
	function roslyn_elated_breadcrumbs_title_area_typography_style() {
		
		$item_styles = roslyn_elated_get_typography_styles( 'page_breadcrumb' );
		
		$item_selector = array(
			'.eltdf-title-holder .eltdf-title-wrapper .eltdf-breadcrumbs'
		);
		
		echo roslyn_elated_dynamic_css( $item_selector, $item_styles );
		
		
		$breadcrumb_hover_color = roslyn_elated_options()->getOptionValue( 'page_breadcrumb_hovercolor' );
		
		$breadcrumb_hover_styles = array();
		if ( ! empty( $breadcrumb_hover_color ) ) {
			$breadcrumb_hover_styles['color'] = $breadcrumb_hover_color;
		}
		
		$breadcrumb_hover_selector = array(
			'.eltdf-title-holder .eltdf-title-wrapper .eltdf-breadcrumbs a:hover'
		);
		
		echo roslyn_elated_dynamic_css( $breadcrumb_hover_selector, $breadcrumb_hover_styles );
	}
	
	add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_breadcrumbs_title_area_typography_style' );
}