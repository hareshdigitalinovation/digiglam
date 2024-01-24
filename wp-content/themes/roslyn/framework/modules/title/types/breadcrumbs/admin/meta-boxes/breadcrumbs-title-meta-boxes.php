<?php

if ( ! function_exists( 'roslyn_elated_breadcrumbs_title_type_options_meta_boxes' ) ) {
	function roslyn_elated_breadcrumbs_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_breadcrumbs_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Breadcrumbs Color', 'roslyn' ),
				'description' => esc_html__( 'Choose a color for breadcrumbs text', 'roslyn' ),
				'parent'      => $show_title_area_meta_container
			)
		);
	}
	
	add_action( 'roslyn_elated_additional_title_area_meta_boxes', 'roslyn_elated_breadcrumbs_title_type_options_meta_boxes' );
}