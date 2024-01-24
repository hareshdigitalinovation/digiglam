<?php

if ( ! function_exists( 'roslyn_elated_get_hide_dep_for_header_centered_meta_boxes' ) ) {
	function roslyn_elated_get_hide_dep_for_header_centered_meta_boxes() {
		$hide_dep_options = apply_filters( 'roslyn_elated_header_centered_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'roslyn_elated_header_centered_meta_map' ) ) {
	function roslyn_elated_header_centered_meta_map( $parent ) {
		$hide_dep_options = roslyn_elated_get_hide_dep_for_header_centered_meta_boxes();
		
		roslyn_elated_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'text',
				'name'            => 'eltdf_logo_wrapper_padding_header_centered_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Logo Padding', 'roslyn' ),
				'description'     => esc_html__( 'Insert padding in format: 0px 0px 1px 0px', 'roslyn' ),
				'args'            => array(
					'col_width' => 3
				),
				'dependency' => array(
					'hide' => array(
						'eltdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'roslyn_elated_header_logo_area_additional_meta_boxes_map', 'roslyn_elated_header_centered_meta_map', 10, 1 );
}