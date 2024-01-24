<?php

if ( ! function_exists( 'roslyn_elated_get_hide_dep_for_header_centered_logo_down_meta_boxes' ) ) {
	function roslyn_elated_get_hide_dep_for_header_centered_logo_down_meta_boxes() {
		$hide_dep_options = apply_filters( 'roslyn_elated_header_centered_logo_down_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'roslyn_elated_header_centered_logo_down_meta_map' ) ) {
	function roslyn_elated_header_centered_logo_down_meta_map( $parent ) {
		$hide_dep_options = roslyn_elated_get_hide_dep_for_header_centered_logo_down_meta_boxes();
		
		roslyn_elated_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'text',
				'name'            => 'eltdf_logo_wrapper_padding_header_centered_logo_down_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Logo Padding', 'roslyn' ),
				'description'     => esc_html__( 'Insert padding in format: 0px 0px 1px 0px', 'roslyn' ),
				'args'            => array(
					'col_width' => 3
				),
				'dependency' => array(
					'hide' => array(
						'eltdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);

        roslyn_elated_create_meta_box_field(
            array(
                'parent'          => $parent,
                'name'          => 'eltdf_disable_centered_left_widget_area_meta',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__( 'Disable Header Menu Left Area Widget', 'roslyn' ),
                'description'   => esc_html__( 'Enabling this option will hide left widget area from the menu area', 'roslyn' ),
                'dependency' => array(
                    'hide' => array(
                        'eltdf_header_type_meta'  => $hide_dep_options
                    )
                )
            )
        );

        $roslyn_custom_sidebars = roslyn_elated_get_custom_sidebars();
        if ( is_array( $roslyn_custom_sidebars ) && count( $roslyn_custom_sidebars ) > 0 ) {
            roslyn_elated_create_meta_box_field(
                array(
                    'parent'          => $parent,
                    'name'        => 'eltdf_custom_centered_left_area_sidebar_meta',
                    'type'        => 'selectblank',
                    'label'       => esc_html__( 'Choose Custom Widget Area In Menu Area', 'roslyn' ),
                    'description' => esc_html__( 'Choose custom widget area to display in header left menu area', 'roslyn' ),
                    'options'     => $roslyn_custom_sidebars,
                    'dependency' => array(
                        'hide' => array(
                            'eltdf_disable_centered_left_widget_area_meta' => 'yes'
                        )
                    )
                )
            );
        }

        roslyn_elated_create_meta_box_field(
            array(
                'parent'          => $parent,
                'name'          => 'eltdf_disable_centered_right_widget_area_meta',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__( 'Disable Header Menu Right Area Widget', 'roslyn' ),
                'description'   => esc_html__( 'Enabling this option will hide right widget area from the menu area', 'roslyn' ),
                'dependency' => array(
                    'hide' => array(
                        'eltdf_header_type_meta'  => $hide_dep_options
                    )
                )
            )
        );

        $roslyn_custom_sidebars = roslyn_elated_get_custom_sidebars();
        if ( is_array( $roslyn_custom_sidebars ) && count( $roslyn_custom_sidebars ) > 0 ) {
            roslyn_elated_create_meta_box_field(
                array(
                    'parent'          => $parent,
                    'name'        => 'eltdf_custom_centered_right_area_sidebar_meta',
                    'type'        => 'selectblank',
                    'label'       => esc_html__( 'Choose Custom Widget Area In Menu Area', 'roslyn' ),
                    'description' => esc_html__( 'Choose custom widget area to display in header right menu area', 'roslyn' ),
                    'options'     => $roslyn_custom_sidebars,
                    'dependency' => array(
                        'hide' => array(
                            'eltdf_disable_centered_left_widget_area_meta' => 'yes'
                        )
                    )
                )
            );
        }
	}
	
	add_action( 'roslyn_elated_header_logo_area_additional_meta_boxes_map', 'roslyn_elated_header_centered_logo_down_meta_map', 10, 1 );
}