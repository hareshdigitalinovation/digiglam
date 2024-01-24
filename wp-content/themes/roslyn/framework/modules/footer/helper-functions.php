<?php

if ( ! function_exists( 'roslyn_elated_footer_skin_class' ) ) {
	/**
	 * Function that adds header style class to body tag
	 */
	function roslyn_elated_footer_skin_class( $classes ) {
		$footer_style     = roslyn_elated_get_meta_field_intersect( 'footer_style', roslyn_elated_get_page_id() );

		 if ( ! empty( $footer_style ) ) {
			$classes[] = 'eltdf-' . $footer_style;
		}

		return $classes;
	}

	add_filter( 'body_class', 'roslyn_elated_footer_skin_class' );
}