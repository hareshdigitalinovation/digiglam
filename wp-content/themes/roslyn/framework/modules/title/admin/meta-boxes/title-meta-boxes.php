<?php

if ( ! function_exists( 'roslyn_elated_get_title_types_meta_boxes' ) ) {
	function roslyn_elated_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'roslyn_elated_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'roslyn' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'roslyn_elated_map_title_meta' ) ) {
	function roslyn_elated_map_title_meta() {
		$title_type_meta_boxes = roslyn_elated_get_title_types_meta_boxes();
		
		$title_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'roslyn_elated_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'roslyn' ),
				'name'  => 'title_meta'
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'roslyn' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'roslyn' ),
				'parent'        => $title_meta_box,
				'options'       => roslyn_elated_get_yes_no_select_array()
			)
		);
		
			$show_title_area_meta_container = roslyn_elated_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'eltdf_show_title_area_meta_container',
					'dependency' => array(
						'hide' => array(
							'eltdf_show_title_area_meta' => 'no'
						)
					)
				)
			);
		
				roslyn_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'roslyn' ),
						'description'   => esc_html__( 'Choose title type', 'roslyn' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				roslyn_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'roslyn' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'roslyn' ),
						'options'       => roslyn_elated_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				roslyn_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'roslyn' ),
						'description' => esc_html__( 'Set a height for Title Area', 'roslyn' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				roslyn_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'roslyn' ),
						'description' => esc_html__( 'Choose a background color for title area', 'roslyn' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				roslyn_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'roslyn' ),
						'description' => esc_html__( 'Choose an Image for title area', 'roslyn' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				roslyn_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'roslyn' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'roslyn' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'roslyn' ),
							'hide'                => esc_html__( 'Hide Image', 'roslyn' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'roslyn' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'roslyn' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'roslyn' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'roslyn' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'roslyn' )
						)
					)
				);
				
				roslyn_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'roslyn' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'roslyn' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'roslyn' ),
							'header-bottom' => esc_html__( 'From Bottom of Header', 'roslyn' ),
							'window-top'    => esc_html__( 'From Window Top', 'roslyn' )
						)
					)
				);

                roslyn_elated_create_meta_box_field(
                    array(
                        'name'          => 'eltdf_show_title_text_meta',
                        'type'          => 'select',
                        'default_value' => '',
                        'label'         => esc_html__( 'Show Title Text', 'roslyn' ),
                        'description'   => esc_html__( 'Display title text in title area', 'roslyn' ),
                        'parent'        => $show_title_area_meta_container,
                        'options'       => array(
                            ''              => esc_html__( 'Default', 'roslyn' ),
                            'yes' => esc_html__( 'Yes', 'roslyn' ),
                            'no'    => esc_html__( 'No', 'roslyn' )
                        )
                    )
                );
				
				roslyn_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'roslyn' ),
						'options'       => roslyn_elated_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				roslyn_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'roslyn' ),
						'description' => esc_html__( 'Choose a color for title text', 'roslyn' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				roslyn_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'roslyn' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'roslyn' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				roslyn_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'roslyn' ),
						'options'       => roslyn_elated_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				roslyn_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'roslyn' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'roslyn' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'roslyn_elated_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_elated_map_title_meta', 60 );
}