<?php

if ( ! function_exists( 'roslyn_elated_get_hide_dep_for_header_logo_area_meta_boxes' ) ) {
	function roslyn_elated_get_hide_dep_for_header_logo_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'roslyn_elated_header_logo_area_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'roslyn_elated_get_hide_dep_for_header_logo_area_widgets_meta_boxes' ) ) {
	function roslyn_elated_get_hide_dep_for_header_logo_area_widgets_meta_boxes() {
		$hide_dep_options = apply_filters( 'roslyn_elated_header_logo_area_widgets_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'roslyn_elated_header_logo_area_meta_options_map' ) ) {
	function roslyn_elated_header_logo_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = roslyn_elated_get_hide_dep_for_header_logo_area_meta_boxes();
		$hide_dep_widgets = roslyn_elated_get_hide_dep_for_header_logo_area_widgets_meta_boxes();
		
		$logo_area_container = roslyn_elated_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_container',
				'parent'          => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'eltdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
		
		roslyn_elated_add_admin_section_title(
			array(
				'parent' => $logo_area_container,
				'name'   => 'logo_area_style',
				'title'  => esc_html__( 'Logo Area Style', 'roslyn' )
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_disable_header_widget_logo_area_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Header Logo Area Widget', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will hide widget area from the logo area', 'roslyn' ),
				'parent'        => $logo_area_container,
				'dependency' => array(
					'hide' => array(
						'eltdf_header_type_meta' => $hide_dep_widgets
					)
				)
			)
		);
		
		$roslyn_custom_sidebars = roslyn_elated_get_custom_sidebars();
		if ( is_array( $roslyn_custom_sidebars ) && count( $roslyn_custom_sidebars ) > 0 ) {
			roslyn_elated_create_meta_box_field(
				array(
					'name'        => 'eltdf_custom_logo_area_sidebar_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Widget Area for Logo Area', 'roslyn' ),
					'description' => esc_html__( 'Choose custom widget area to display in header logo area"', 'roslyn' ),
					'parent'      => $logo_area_container,
					'options'     => $roslyn_custom_sidebars,
					'dependency' => array(
						'hide' => array(
							'eltdf_header_type_meta' => $hide_dep_widgets
						)
					)
				)
			);
		}
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_logo_area_in_grid_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Logo Area In Grid', 'roslyn' ),
				'description'   => esc_html__( 'Set menu area content to be in grid', 'roslyn' ),
				'parent'        => $logo_area_container,
				'default_value' => '',
				'options'       => roslyn_elated_get_yes_no_select_array()
			)
		);
		
		$logo_area_in_grid_container = roslyn_elated_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_in_grid_container',
				'parent'          => $logo_area_container,
				'dependency' => array(
					'show' => array(
						'eltdf_logo_area_in_grid_meta'  => 'yes'
					)
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_area_grid_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Grid Background Color', 'roslyn' ),
				'description' => esc_html__( 'Set grid background color for logo area', 'roslyn' ),
				'parent'      => $logo_area_in_grid_container
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_area_grid_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Grid Background Transparency', 'roslyn' ),
				'description' => esc_html__( 'Set grid background transparency for logo area (0 = fully transparent, 1 = opaque)', 'roslyn' ),
				'parent'      => $logo_area_in_grid_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_logo_area_in_grid_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Grid Area Border', 'roslyn' ),
				'description'   => esc_html__( 'Set border on grid logo area', 'roslyn' ),
				'parent'        => $logo_area_in_grid_container,
				'default_value' => '',
				'options'       => roslyn_elated_get_yes_no_select_array()
			)
		);
		
		$logo_area_in_grid_border_container = roslyn_elated_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_in_grid_border_container',
				'parent'          => $logo_area_in_grid_container,
				'dependency' => array(
					'show' => array(
						'eltdf_logo_area_in_grid_border_meta'  => 'yes'
					)
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_area_in_grid_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'roslyn' ),
				'description' => esc_html__( 'Set border color for grid area', 'roslyn' ),
				'parent'      => $logo_area_in_grid_border_container
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_area_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'roslyn' ),
				'description' => esc_html__( 'Choose a background color for logo area', 'roslyn' ),
				'parent'      => $logo_area_container
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_area_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Transparency', 'roslyn' ),
				'description' => esc_html__( 'Choose a transparency for the logo area background color (0 = fully transparent, 1 = opaque)', 'roslyn' ),
				'parent'      => $logo_area_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_logo_area_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Logo Area Border', 'roslyn' ),
				'description'   => esc_html__( 'Set border on logo area', 'roslyn' ),
				'parent'        => $logo_area_container,
				'default_value' => '',
				'options'       => roslyn_elated_get_yes_no_select_array()
			)
		);
		
		$logo_area_border_bottom_color_container = roslyn_elated_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_border_bottom_color_container',
				'parent'          => $logo_area_container,
				'dependency' => array(
					'show' => array(
						'eltdf_logo_area_border_meta'  => 'yes'
					)
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_area_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'roslyn' ),
				'description' => esc_html__( 'Choose color of header bottom border', 'roslyn' ),
				'parent'      => $logo_area_border_bottom_color_container
			)
		);
		
		do_action( 'roslyn_elated_header_logo_area_additional_meta_boxes_map', $logo_area_container );
	}
	
	add_action( 'roslyn_elated_header_logo_area_meta_boxes_map', 'roslyn_elated_header_logo_area_meta_options_map', 10, 1 );
}