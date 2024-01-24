<?php

if ( ! function_exists( 'roslyn_elated_set_title_centered_type_for_options' ) ) {
	/**
	 * This function set centered title type value for title options map and meta boxes
	 */
	function roslyn_elated_set_title_centered_type_for_options( $type ) {
		$type['centered'] = esc_html__( 'Centered', 'roslyn' );
		
		return $type;
	}
	
	add_filter( 'roslyn_elated_title_type_global_option', 'roslyn_elated_set_title_centered_type_for_options' );
	add_filter( 'roslyn_elated_title_type_meta_boxes', 'roslyn_elated_set_title_centered_type_for_options' );
}