<?php

if ( ! function_exists( 'roslyn_elated_map_post_quote_meta' ) ) {
	function roslyn_elated_map_post_quote_meta() {
		$quote_post_format_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'roslyn' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'roslyn' ),
				'description' => esc_html__( 'Enter Quote text', 'roslyn' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'roslyn' ),
				'description' => esc_html__( 'Enter Quote author', 'roslyn' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_elated_map_post_quote_meta', 25 );
}