<?php

if ( ! function_exists( 'roslyn_elated_get_hide_dep_for_header_standard_options' ) ) {
	function roslyn_elated_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'roslyn_elated_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'roslyn_elated_header_standard_map' ) ) {
	function roslyn_elated_header_standard_map( $parent ) {
		$hide_dep_options = roslyn_elated_get_hide_dep_for_header_standard_options();
		
		roslyn_elated_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'roslyn' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'roslyn' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'roslyn' ),
					'left'   => esc_html__( 'Left', 'roslyn' ),
					'center' => esc_html__( 'Center', 'roslyn' )
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'roslyn_elated_additional_header_menu_area_options_map', 'roslyn_elated_header_standard_map' );
}