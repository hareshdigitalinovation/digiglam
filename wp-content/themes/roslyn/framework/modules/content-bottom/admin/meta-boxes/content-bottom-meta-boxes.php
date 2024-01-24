<?php

if ( ! function_exists( 'roslyn_elated_map_content_bottom_meta' ) ) {
	function roslyn_elated_map_content_bottom_meta() {
		
		$content_bottom_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'roslyn_elated_set_scope_for_meta_boxes', array( 'page', 'post' ), 'content_bottom_meta' ),
				'title' => esc_html__( 'Content Bottom', 'roslyn' ),
				'name'  => 'content_bottom_meta'
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_enable_content_bottom_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'roslyn' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'roslyn' ),
				'parent'        => $content_bottom_meta_box,
				'options'       => roslyn_elated_get_yes_no_select_array()
			)
		);
		
		$show_content_bottom_meta_container = roslyn_elated_add_admin_container(
			array(
				'parent'          => $content_bottom_meta_box,
				'name'            => 'eltdf_show_content_bottom_meta_container',
				'dependency' => array(
					'show' => array(
						'eltdf_enable_content_bottom_area_meta' => 'yes'
					)
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_content_bottom_sidebar_custom_display_meta',
				'type'          => 'selectblank',
				'default_value' => '',
				'label'         => esc_html__( 'Sidebar to Display', 'roslyn' ),
				'description'   => esc_html__( 'Choose a content bottom sidebar to display', 'roslyn' ),
				'options'       => roslyn_elated_get_custom_sidebars(),
				'parent'        => $show_content_bottom_meta_container,
				'args'          => array(
					'select2' => true
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'type'          => 'select',
				'name'          => 'eltdf_content_bottom_in_grid_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Display in Grid', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will place content bottom in grid', 'roslyn' ),
				'options'       => roslyn_elated_get_yes_no_select_array(),
				'parent'        => $show_content_bottom_meta_container
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'type'        => 'color',
				'name'        => 'eltdf_content_bottom_background_color_meta',
				'label'       => esc_html__( 'Background Color', 'roslyn' ),
				'description' => esc_html__( 'Choose a background color for content bottom area', 'roslyn' ),
				'parent'      => $show_content_bottom_meta_container
			)
		);
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_elated_map_content_bottom_meta', 71 );
}