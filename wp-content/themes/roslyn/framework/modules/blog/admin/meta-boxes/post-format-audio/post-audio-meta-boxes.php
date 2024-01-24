<?php

if ( ! function_exists( 'roslyn_elated_map_post_audio_meta' ) ) {
	function roslyn_elated_map_post_audio_meta() {
		$audio_post_format_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'roslyn' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'roslyn' ),
				'description'   => esc_html__( 'Choose audio type', 'roslyn' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'roslyn' ),
					'self'            => esc_html__( 'Self Hosted', 'roslyn' )
				)
			)
		);
		
		$eltdf_audio_embedded_container = roslyn_elated_add_admin_container(
			array(
				'parent' => $audio_post_format_meta_box,
				'name'   => 'eltdf_audio_embedded_container'
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'roslyn' ),
				'description' => esc_html__( 'Enter audio URL', 'roslyn' ),
				'parent'      => $eltdf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_audio_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'roslyn' ),
				'description' => esc_html__( 'Enter audio link', 'roslyn' ),
				'parent'      => $eltdf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_audio_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_elated_map_post_audio_meta', 23 );
}