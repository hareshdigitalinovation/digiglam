<?php

if ( ! function_exists( 'roslyn_core_map_testimonials_meta' ) ) {
	function roslyn_core_map_testimonials_meta() {
		$testimonial_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'roslyn-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'roslyn-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'roslyn-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'roslyn-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'roslyn-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'roslyn-core' ),
				'description' => esc_html__( 'Enter author name', 'roslyn-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'roslyn-core' ),
				'description' => esc_html__( 'Enter author job position', 'roslyn-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_core_map_testimonials_meta', 95 );
}