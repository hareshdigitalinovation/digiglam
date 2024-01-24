<?php

if ( ! function_exists( 'roslyn_elated_logo_meta_box_map' ) ) {
	function roslyn_elated_logo_meta_box_map() {
		
		$logo_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'roslyn_elated_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'roslyn' ),
				'name'  => 'logo_meta'
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'roslyn' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'roslyn' ),
				'parent'      => $logo_meta_box
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'roslyn' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'roslyn' ),
				'parent'      => $logo_meta_box
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'roslyn' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'roslyn' ),
				'parent'      => $logo_meta_box
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'roslyn' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'roslyn' ),
				'parent'      => $logo_meta_box
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'roslyn' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'roslyn' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_elated_logo_meta_box_map', 47 );
}