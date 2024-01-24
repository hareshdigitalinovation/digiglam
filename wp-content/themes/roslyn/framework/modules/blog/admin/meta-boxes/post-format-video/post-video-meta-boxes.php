<?php

if ( ! function_exists( 'roslyn_elated_map_post_video_meta' ) ) {
	function roslyn_elated_map_post_video_meta() {
		$video_post_format_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'roslyn' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'roslyn' ),
				'description'   => esc_html__( 'Choose video type', 'roslyn' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'roslyn' ),
					'self'            => esc_html__( 'Self Hosted', 'roslyn' )
				)
			)
		);
		
		$eltdf_video_embedded_container = roslyn_elated_add_admin_container(
			array(
				'parent' => $video_post_format_meta_box,
				'name'   => 'eltdf_video_embedded_container'
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'roslyn' ),
				'description' => esc_html__( 'Enter Video URL', 'roslyn' ),
				'parent'      => $eltdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_video_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'roslyn' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'roslyn' ),
				'parent'      => $eltdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_video_type_meta' => 'self'
					)
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'roslyn' ),
				'description' => esc_html__( 'Enter video image', 'roslyn' ),
				'parent'      => $eltdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_video_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_elated_map_post_video_meta', 22 );
}