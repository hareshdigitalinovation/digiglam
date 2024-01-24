<?php

if ( ! function_exists( 'roslyn_elated_map_sidebar_meta' ) ) {
	function roslyn_elated_map_sidebar_meta() {
		$eltdf_sidebar_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'roslyn_elated_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'roslyn' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'roslyn' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'roslyn' ),
				'parent'      => $eltdf_sidebar_meta_box,
                'options'       => roslyn_elated_get_custom_sidebars_options( true )
			)
		);
		
		$eltdf_custom_sidebars = roslyn_elated_get_custom_sidebars();
		if ( is_array( $eltdf_custom_sidebars ) && count( $eltdf_custom_sidebars ) > 0 ) {
			roslyn_elated_create_meta_box_field(
				array(
					'name'        => 'eltdf_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'roslyn' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'roslyn' ),
					'parent'      => $eltdf_sidebar_meta_box,
					'options'     => $eltdf_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_elated_map_sidebar_meta', 31 );
}