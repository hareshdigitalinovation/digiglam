<?php

if ( ! function_exists( 'roslyn_elated_header_types_meta_boxes' ) ) {
	function roslyn_elated_header_types_meta_boxes() {
		$header_type_options = apply_filters( 'roslyn_elated_header_type_meta_boxes', $header_type_options = array( '' => esc_html__( 'Default', 'roslyn' ) ) );
		
		return $header_type_options;
	}
}

if ( ! function_exists( 'roslyn_elated_get_hide_dep_for_header_behavior_meta_boxes' ) ) {
	function roslyn_elated_get_hide_dep_for_header_behavior_meta_boxes() {
		$hide_dep_options = apply_filters( 'roslyn_elated_header_behavior_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

foreach ( glob( ELATED_FRAMEWORK_HEADER_ROOT_DIR . '/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

foreach ( glob( ELATED_FRAMEWORK_HEADER_TYPES_ROOT_DIR . '/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'roslyn_elated_map_header_meta' ) ) {
	function roslyn_elated_map_header_meta() {
		$header_type_meta_boxes              = roslyn_elated_header_types_meta_boxes();
		$header_behavior_meta_boxes_hide_dep = roslyn_elated_get_hide_dep_for_header_behavior_meta_boxes();
		
		$header_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'roslyn_elated_set_scope_for_meta_boxes', array( 'page', 'post' ), 'header_meta' ),
				'title' => esc_html__( 'Header', 'roslyn' ),
				'name'  => 'header_meta'
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_header_type_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Choose Header Type', 'roslyn' ),
				'description'   => esc_html__( 'Select header type layout', 'roslyn' ),
				'parent'        => $header_meta_box,
				'options'       => $header_type_meta_boxes
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_header_style_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Header Skin', 'roslyn' ),
				'description'   => esc_html__( 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'roslyn' ),
				'parent'        => $header_meta_box,
				'options'       => array(
					''             => esc_html__( 'Default', 'roslyn' ),
					'light-header' => esc_html__( 'Light', 'roslyn' ),
					'dark-header'  => esc_html__( 'Dark', 'roslyn' )
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'parent'          => $header_meta_box,
				'type'            => 'select',
				'name'            => 'eltdf_header_behaviour_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Header Behaviour', 'roslyn' ),
				'description'     => esc_html__( 'Select the behaviour of header when you scroll down to page', 'roslyn' ),
				'options'         => array(
					''                                => esc_html__( 'Default', 'roslyn' ),
					'fixed-on-scroll'                 => esc_html__( 'Fixed on scroll', 'roslyn' ),
					'no-behavior'                     => esc_html__( 'No Behavior', 'roslyn' ),
					'sticky-header-on-scroll-up'      => esc_html__( 'Sticky on scroll up', 'roslyn' ),
					'sticky-header-on-scroll-down-up' => esc_html__( 'Sticky on scroll up/down', 'roslyn' )
				),
				'dependency' => array(
					'hide' => array(
						'eltdf_header_type_meta'  => $header_behavior_meta_boxes_hide_dep
					)
				)
			)
		);
		
		//additional area
		do_action( 'roslyn_elated_additional_header_area_meta_boxes_map', $header_meta_box );
		
		//top area
		do_action( 'roslyn_elated_header_top_area_meta_boxes_map', $header_meta_box );
		
		//logo area
		do_action( 'roslyn_elated_header_logo_area_meta_boxes_map', $header_meta_box );
		
		//menu area
		do_action( 'roslyn_elated_header_menu_area_meta_boxes_map', $header_meta_box );
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_elated_map_header_meta', 50 );
}