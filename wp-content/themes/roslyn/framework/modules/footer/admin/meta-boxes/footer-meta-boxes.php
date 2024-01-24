<?php

if ( ! function_exists( 'roslyn_elated_map_footer_meta' ) ) {
	function roslyn_elated_map_footer_meta() {
		
		$footer_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'roslyn_elated_set_scope_for_meta_boxes', array( 'page', 'post' ), 'footer_meta' ),
				'title' => esc_html__( 'Footer', 'roslyn' ),
				'name'  => 'footer_meta'
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_disable_footer_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Disable Footer for this Page', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'roslyn' ),
				'options'       => roslyn_elated_get_yes_no_select_array(),
				'parent'        => $footer_meta_box
			)
		);
		
		$show_footer_meta_container = roslyn_elated_add_admin_container(
			array(
				'name'       => 'eltdf_show_footer_meta_container',
				'parent'     => $footer_meta_box,
				'dependency' => array(
					'hide' => array(
						'eltdf_disable_footer_meta' => 'yes'
					)
				)
			)
		);
		
			roslyn_elated_create_meta_box_field(
				array(
					'name'          => 'eltdf_footer_in_grid_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Footer in Grid', 'roslyn' ),
					'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'roslyn' ),
					'options'       => roslyn_elated_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
			
			roslyn_elated_create_meta_box_field(
				array(
					'name'          => 'eltdf_uncovering_footer_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Uncovering Footer', 'roslyn' ),
					'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'roslyn' ),
					'options'       => roslyn_elated_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			roslyn_elated_create_meta_box_field(
				array(
					'name'          => 'eltdf_show_footer_top_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Top', 'roslyn' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'roslyn' ),
					'options'       => roslyn_elated_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			roslyn_elated_create_meta_box_field(
				array(
					'name'        => 'eltdf_footer_top_background_color_meta',
					'type'        => 'color',
					'label'       => esc_html__( 'Footer Top Background Color', 'roslyn' ),
					'description' => esc_html__( 'Set background color for top footer area', 'roslyn' ),
					'parent'      => $show_footer_meta_container,
					'dependency' => array(
						'show' => array(
							'eltdf_show_footer_top_meta' => array( '', 'yes' )
						)
					)
				)
			);
			
			roslyn_elated_create_meta_box_field(
				array(
					'name'          => 'eltdf_show_footer_bottom_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Bottom', 'roslyn' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'roslyn' ),
					'options'       => roslyn_elated_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			roslyn_elated_create_meta_box_field(
				array(
					'name'        => 'eltdf_footer_bottom_background_color_meta',
					'type'        => 'color',
					'label'       => esc_html__( 'Footer Bottom Background Color', 'roslyn' ),
					'description' => esc_html__( 'Set background color for bottom footer area', 'roslyn' ),
					'parent'      => $show_footer_meta_container,
					'dependency' => array(
						'show' => array(
							'eltdf_show_footer_bottom_meta' => array( '', 'yes' )
						)
					)
				)
			);
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_elated_map_footer_meta', 70 );
}