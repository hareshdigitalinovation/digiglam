<?php

if ( ! function_exists( 'roslyn_elated_get_hide_dep_for_header_menu_area_options' ) ) {
	function roslyn_elated_get_hide_dep_for_header_menu_area_options() {
		$hide_dep_options = apply_filters( 'roslyn_elated_header_menu_area_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'roslyn_elated_header_menu_area_options_map' ) ) {
	function roslyn_elated_header_menu_area_options_map( $panel_header ) {
		$hide_dep_options = roslyn_elated_get_hide_dep_for_header_menu_area_options();
		
		$menu_area_container = roslyn_elated_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'menu_area_container',
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				),
			)
		);
		
		roslyn_elated_add_admin_section_title(
			array(
				'parent' => $menu_area_container,
				'name'   => 'menu_area_style',
				'title'  => esc_html__( 'Menu Area Style', 'roslyn' )
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area In Grid', 'roslyn' ),
				'description'   => esc_html__( 'Set menu area content to be in grid', 'roslyn' ),
			)
		);
		
		$menu_area_in_grid_container = roslyn_elated_add_admin_container(
			array(
				'parent'          => $menu_area_container,
				'name'            => 'menu_area_in_grid_container',
				'dependency' => array(
					'hide' => array(
						'menu_area_in_grid'  => 'no'
					)
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'color',
				'name'          => 'menu_area_grid_background_color',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Color', 'roslyn' ),
				'description'   => esc_html__( 'Set grid background color for menu area', 'roslyn' ),
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'text',
				'name'          => 'menu_area_grid_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Transparency', 'roslyn' ),
				'description'   => esc_html__( 'Set grid background transparency for menu area', 'roslyn' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Grid Area Shadow', 'roslyn' ),
				'description'   => esc_html__( 'Set shadow on grid area', 'roslyn' )
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Grid Area Border', 'roslyn' ),
				'description'   => esc_html__( 'Set border on grid area', 'roslyn' )
			)
		);
		
		$menu_area_in_grid_border_container = roslyn_elated_add_admin_container(
			array(
				'parent'          => $menu_area_in_grid_container,
				'name'            => 'menu_area_in_grid_border_container',
				'dependency' => array(
					'hide' => array(
						'menu_area_in_grid_border'  => 'no'
					)
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_border_container,
				'type'          => 'color',
				'name'          => 'menu_area_in_grid_border_color',
				'default_value' => '',
				'label'         => esc_html__( 'Border Color', 'roslyn' ),
				'description'   => esc_html__( 'Set border color for menu area', 'roslyn' ),
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'color',
				'name'          => 'menu_area_background_color',
				'default_value' => '',
				'label'         => esc_html__( 'Background Color', 'roslyn' ),
				'description'   => esc_html__( 'Set background color for menu area', 'roslyn' )
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'text',
				'name'          => 'menu_area_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Background Transparency', 'roslyn' ),
				'description'   => esc_html__( 'Set background transparency for menu area', 'roslyn' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area Shadow', 'roslyn' ),
				'description'   => esc_html__( 'Set shadow on menu area', 'roslyn' ),
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'menu_area_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area Border', 'roslyn' ),
				'description'   => esc_html__( 'Set border on menu area', 'roslyn' ),
				'parent'        => $menu_area_container
			)
		);
		
		$menu_area_border_container = roslyn_elated_add_admin_container(
			array(
				'parent'          => $menu_area_container,
				'name'            => 'menu_area_border_container',
				'dependency' => array(
					'hide' => array(
						'menu_area_border'  => 'no'
					)
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'menu_area_border_color',
				'label'       => esc_html__( 'Border Color', 'roslyn' ),
				'description' => esc_html__( 'Set border color for menu area', 'roslyn' ),
				'parent'      => $menu_area_border_container
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'        => 'text',
				'name'        => 'menu_area_height',
				'label'       => esc_html__( 'Height', 'roslyn' ),
				'description' => esc_html__( 'Enter header height', 'roslyn' ),
				'parent'      => $menu_area_container,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'   => 'text',
				'name'   => 'menu_area_side_padding',
				'label'  => esc_html__( 'Menu Area Side Padding', 'roslyn' ),
				'parent' => $menu_area_container,
				'args'   => array(
					'col_width' => 2,
					'suffix'    => esc_html__( 'px or %', 'roslyn' )
				)
			)
		);
		
		do_action( 'roslyn_elated_header_menu_area_additional_options', $panel_header );
	}
	
	add_action( 'roslyn_elated_header_menu_area_options_map', 'roslyn_elated_header_menu_area_options_map', 10, 1 );
}