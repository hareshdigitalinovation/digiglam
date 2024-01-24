<?php

if ( ! function_exists( 'roslyn_elated_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function roslyn_elated_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'roslyn_elated_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'roslyn_elated_header_standard_meta_map' ) ) {
	function roslyn_elated_header_standard_meta_map( $parent ) {
		$hide_dep_options = roslyn_elated_get_hide_dep_for_header_standard_meta_boxes();
		
		roslyn_elated_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'eltdf_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'roslyn' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'roslyn' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'roslyn' ),
					'left'   => esc_html__( 'Left', 'roslyn' ),
					'right'  => esc_html__( 'Right', 'roslyn' ),
					'center' => esc_html__( 'Center', 'roslyn' )
				),
				'dependency' => array(
					'hide' => array(
						'eltdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'roslyn_elated_additional_header_area_meta_boxes_map', 'roslyn_elated_header_standard_meta_map' );
}