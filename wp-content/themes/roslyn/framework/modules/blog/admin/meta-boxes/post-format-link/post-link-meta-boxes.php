<?php

if ( ! function_exists( 'roslyn_elated_map_post_link_meta' ) ) {
	function roslyn_elated_map_post_link_meta() {
		$link_post_format_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'roslyn' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'roslyn' ),
				'description' => esc_html__( 'Enter link', 'roslyn' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_elated_map_post_link_meta', 24 );
}