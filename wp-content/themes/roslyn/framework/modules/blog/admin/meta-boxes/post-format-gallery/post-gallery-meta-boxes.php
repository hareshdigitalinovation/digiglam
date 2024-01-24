<?php

if ( ! function_exists( 'roslyn_elated_map_post_gallery_meta' ) ) {
	
	function roslyn_elated_map_post_gallery_meta() {
		$gallery_post_format_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'roslyn' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		roslyn_elated_add_multiple_images_field(
			array(
				'name'        => 'eltdf_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'roslyn' ),
				'description' => esc_html__( 'Choose your gallery images', 'roslyn' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_elated_map_post_gallery_meta', 21 );
}
