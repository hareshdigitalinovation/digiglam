<?php

if ( ! function_exists( 'roslyn_elated_set_title_standard_type_for_options' ) ) {
	/**
	 * This function set standard title type value for title options map and meta boxes
	 */
	function roslyn_elated_set_title_standard_type_for_options( $type ) {
		$type['standard'] = esc_html__( 'Standard', 'roslyn' );
		
		return $type;
	}
	
	add_filter( 'roslyn_elated_title_type_global_option', 'roslyn_elated_set_title_standard_type_for_options' );
	add_filter( 'roslyn_elated_title_type_meta_boxes', 'roslyn_elated_set_title_standard_type_for_options' );
}

if ( ! function_exists( 'roslyn_elated_set_title_standard_type_as_default_options' ) ) {
	/**
	 * This function set default title type value for global title option map
	 */
	function roslyn_elated_set_title_standard_type_as_default_options( $type ) {
		$type = 'standard';
		
		return $type;
	}
	
	add_filter( 'roslyn_elated_default_title_type_global_option', 'roslyn_elated_set_title_standard_type_as_default_options' );
}