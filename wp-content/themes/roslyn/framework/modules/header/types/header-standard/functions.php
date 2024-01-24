<?php

if ( ! function_exists( 'roslyn_elated_register_header_standard_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function roslyn_elated_register_header_standard_type( $header_types ) {
		$header_type = array(
			'header-standard' => 'RoslynElated\Modules\Header\Types\HeaderStandard'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'roslyn_elated_init_register_header_standard_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function roslyn_elated_init_register_header_standard_type() {
		add_filter( 'roslyn_elated_register_header_type_class', 'roslyn_elated_register_header_standard_type' );
	}
	
	add_action( 'roslyn_elated_before_header_function_init', 'roslyn_elated_init_register_header_standard_type' );
}