<?php

if ( ! function_exists( 'roslyn_elated_centered_title_type_options_meta_boxes' ) ) {
	function roslyn_elated_centered_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_subtitle_side_padding_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Subtitle Side Padding', 'roslyn' ),
				'description' => esc_html__( 'Set left/right padding for subtitle area', 'roslyn' ),
				'parent'      => $show_title_area_meta_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				)
			)
		);
	}
	
	add_action( 'roslyn_elated_additional_title_area_meta_boxes', 'roslyn_elated_centered_title_type_options_meta_boxes', 5 );
}