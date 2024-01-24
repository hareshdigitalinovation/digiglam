<?php

if ( ! function_exists( 'roslyn_elated_get_title_types_options' ) ) {
	function roslyn_elated_get_title_types_options() {
		$title_type_options = apply_filters( 'roslyn_elated_title_type_global_option', $title_type_options = array() );
		
		return $title_type_options;
	}
}

if ( ! function_exists( 'roslyn_elated_get_title_type_default_options' ) ) {
	function roslyn_elated_get_title_type_default_options() {
		$title_type_option = apply_filters( 'roslyn_elated_default_title_type_global_option', $title_type_option = '' );
		
		return $title_type_option;
	}
}

foreach ( glob( ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/options-map/*.php' ) as $options_load ) {
	include_once $options_load;
}

if ( ! function_exists('roslyn_elated_title_options_map') ) {
	function roslyn_elated_title_options_map() {
		$title_type_options        = roslyn_elated_get_title_types_options();
		$title_type_default_option = roslyn_elated_get_title_type_default_options();

		roslyn_elated_add_admin_page(
			array(
				'slug' => '_title_page',
				'title' => esc_html__('Title', 'roslyn'),
				'icon' => 'fa fa-list-alt'
			)
		);

		$panel_title = roslyn_elated_add_admin_panel(
			array(
				'page' => '_title_page',
				'name' => 'panel_title',
				'title' => esc_html__('Title Settings', 'roslyn')
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'show_title_area',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Title Area', 'roslyn' ),
				'description'   => esc_html__( 'This option will enable/disable Title Area', 'roslyn' ),
				'parent'        => $panel_title
			)
		);
		
			$show_title_area_container = roslyn_elated_add_admin_container(
				array(
					'parent'          => $panel_title,
					'name'            => 'show_title_area_container',
					'dependency' => array(
						'show' => array(
							'show_title_area' => 'yes'
						)
					)
				)
			);
		
				roslyn_elated_add_admin_field(
					array(
						'name'          => 'title_area_type',
						'type'          => 'select',
						'default_value' => $title_type_default_option,
						'label'         => esc_html__( 'Title Area Type', 'roslyn' ),
						'description'   => esc_html__( 'Choose title type', 'roslyn' ),
						'parent'        => $show_title_area_container,
						'options'       => $title_type_options
					)
				);
		
					roslyn_elated_add_admin_field(
						array(
							'name'          => 'title_area_in_grid',
							'type'          => 'yesno',
							'default_value' => 'yes',
							'label'         => esc_html__( 'Title Area In Grid', 'roslyn' ),
							'description'   => esc_html__( 'Set title area content to be in grid', 'roslyn' ),
							'parent'        => $show_title_area_container
						)
					);
		
					roslyn_elated_add_admin_field(
						array(
							'name'        => 'title_area_height',
							'type'        => 'text',
							'label'       => esc_html__( 'Height', 'roslyn' ),
							'description' => esc_html__( 'Set a height for Title Area', 'roslyn' ),
							'parent'      => $show_title_area_container,
							'args'        => array(
								'col_width' => 2,
								'suffix'    => 'px'
							)
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'name'        => 'title_area_background_color',
							'type'        => 'color',
							'label'       => esc_html__( 'Background Color', 'roslyn' ),
							'description' => esc_html__( 'Choose a background color for Title Area', 'roslyn' ),
							'parent'      => $show_title_area_container
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'name'        => 'title_area_background_image',
							'type'        => 'image',
							'label'       => esc_html__( 'Background Image', 'roslyn' ),
							'description' => esc_html__( 'Choose an Image for Title Area', 'roslyn' ),
							'parent'      => $show_title_area_container
						)
					);
		
					roslyn_elated_add_admin_field(
						array(
							'name'          => 'title_area_background_image_behavior',
							'type'          => 'select',
							'default_value' => '',
							'label'         => esc_html__( 'Background Image Behavior', 'roslyn' ),
							'description'   => esc_html__( 'Choose title area background image behavior', 'roslyn' ),
							'parent'        => $show_title_area_container,
							'options'       => array(
								''                  => esc_html__( 'Default', 'roslyn' ),
								'responsive'        => esc_html__( 'Enable Responsive Image', 'roslyn' ),
								'parallax'          => esc_html__( 'Enable Parallax Image', 'roslyn' ),
								'parallax-zoom-out' => esc_html__( 'Enable Parallax With Zoom Out Image', 'roslyn' )
							)
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'name'          => 'title_area_vertical_alignment',
							'type'          => 'select',
							'default_value' => 'header-bottom',
							'label'         => esc_html__( 'Vertical Alignment', 'roslyn' ),
							'description'   => esc_html__( 'Specify title vertical alignment', 'roslyn' ),
							'parent'        => $show_title_area_container,
							'options'       => array(
								'header-bottom' => esc_html__( 'From Bottom of Header', 'roslyn' ),
								'window-top'    => esc_html__( 'From Window Top', 'roslyn' )
							)
						)
					);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'roslyn_elated_additional_title_area_options_map', $show_title_area_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
		
		$panel_typography = roslyn_elated_add_admin_panel(
			array(
				'page'  => '_title_page',
				'name'  => 'panel_title_typography',
				'title' => esc_html__( 'Typography', 'roslyn' )
			)
		);
		
			roslyn_elated_add_admin_section_title(
				array(
					'name'   => 'type_section_title',
					'title'  => esc_html__( 'Title', 'roslyn' ),
					'parent' => $panel_typography
				)
			);

            roslyn_elated_add_admin_field(
                array(
                    'name'          => 'show_title_text',
                    'type'          => 'yesno',
                    'default_value' => 'yes',
                    'label'         => esc_html__( 'Show Title Area Text', 'roslyn' ),
                    'description'   => esc_html__( 'Display title area title text', 'roslyn' ),
                    'parent'        => $panel_typography
                )
            );
		
			$group_page_title_styles = roslyn_elated_add_admin_group(
				array(
					'name'        => 'group_page_title_styles',
					'title'       => esc_html__( 'Title', 'roslyn' ),
					'description' => esc_html__( 'Define styles for page title', 'roslyn' ),
					'parent'      => $panel_typography,
                    'dependency' => array(
                        'show' => array(
                            'show_title_text' => 'yes'
                        )
                    )
				)
			);
		
				$row_page_title_styles_1 = roslyn_elated_add_admin_row(
					array(
						'name'   => 'row_page_title_styles_1',
						'parent' => $group_page_title_styles
					)
				);
		
					roslyn_elated_add_admin_field(
						array(
							'name'          => 'title_area_title_tag',
							'type'          => 'selectsimple',
							'default_value' => 'h1',
							'label'         => esc_html__( 'Title Tag', 'roslyn' ),
							'options'       => roslyn_elated_get_title_tag(),
							'parent'        => $row_page_title_styles_1
						)
					);
		
				$row_page_title_styles_2 = roslyn_elated_add_admin_row(
					array(
						'name'   => 'row_page_title_styles_2',
						'parent' => $group_page_title_styles
					)
				);
		
					roslyn_elated_add_admin_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'page_title_color',
							'label'  => esc_html__( 'Text Color', 'roslyn' ),
							'parent' => $row_page_title_styles_2
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_title_font_size',
							'default_value' => '',
							'label'         => esc_html__( 'Font Size', 'roslyn' ),
							'parent'        => $row_page_title_styles_2,
							'args'          => array(
								'suffix' => 'px'
							)
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_title_line_height',
							'default_value' => '',
							'label'         => esc_html__( 'Line Height', 'roslyn' ),
							'parent'        => $row_page_title_styles_2,
							'args'          => array(
								'suffix' => 'px'
							)
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_title_text_transform',
							'default_value' => '',
							'label'         => esc_html__( 'Text Transform', 'roslyn' ),
							'options'       => roslyn_elated_get_text_transform_array(),
							'parent'        => $row_page_title_styles_2
						)
					);
		
				$row_page_title_styles_3 = roslyn_elated_add_admin_row(
					array(
						'name'   => 'row_page_title_styles_3',
						'parent' => $group_page_title_styles,
						'next'   => true
					)
				);
		
					roslyn_elated_add_admin_field(
						array(
							'type'          => 'fontsimple',
							'name'          => 'page_title_google_fonts',
							'default_value' => '-1',
							'label'         => esc_html__( 'Font Family', 'roslyn' ),
							'parent'        => $row_page_title_styles_3
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_title_font_style',
							'default_value' => '',
							'label'         => esc_html__( 'Font Style', 'roslyn' ),
							'options'       => roslyn_elated_get_font_style_array(),
							'parent'        => $row_page_title_styles_3
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_title_font_weight',
							'default_value' => '',
							'label'         => esc_html__( 'Font Weight', 'roslyn' ),
							'options'       => roslyn_elated_get_font_weight_array(),
							'parent'        => $row_page_title_styles_3
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_title_letter_spacing',
							'default_value' => '',
							'label'         => esc_html__( 'Letter Spacing', 'roslyn' ),
							'parent'        => $row_page_title_styles_3,
							'args'          => array(
								'suffix' => 'px'
							)
						)
					);
		
			roslyn_elated_add_admin_section_title(
				array(
					'name'   => 'type_section_subtitle',
					'title'  => esc_html__( 'Subtitle', 'roslyn' ),
					'parent' => $panel_typography
				)
			);
		
			$group_page_subtitle_styles = roslyn_elated_add_admin_group(
				array(
					'name'        => 'group_page_subtitle_styles',
					'title'       => esc_html__( 'Subtitle', 'roslyn' ),
					'description' => esc_html__( 'Define styles for page subtitle', 'roslyn' ),
					'parent'      => $panel_typography
				)
			);
		
				$row_page_subtitle_styles_1 = roslyn_elated_add_admin_row(
					array(
						'name'   => 'row_page_subtitle_styles_1',
						'parent' => $group_page_subtitle_styles
					)
				);
				
					roslyn_elated_add_admin_field(
						array(
							'name' => 'title_area_subtitle_tag',
							'type' => 'selectsimple',
							'default_value' => 'h6',
							'label' => esc_html__('Subtitle Tag', 'roslyn'),
							'options' => roslyn_elated_get_title_tag(),
							'parent' => $row_page_subtitle_styles_1
						)
					);
		
				$row_page_subtitle_styles_2 = roslyn_elated_add_admin_row(
					array(
						'name'   => 'row_page_subtitle_styles_2',
						'parent' => $group_page_subtitle_styles
					)
				);
		
					roslyn_elated_add_admin_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'page_subtitle_color',
							'label'  => esc_html__( 'Text Color', 'roslyn' ),
							'parent' => $row_page_subtitle_styles_2
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_subtitle_font_size',
							'default_value' => '',
							'label'         => esc_html__( 'Font Size', 'roslyn' ),
							'parent'        => $row_page_subtitle_styles_2,
							'args'          => array(
								'suffix' => 'px'
							)
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_subtitle_line_height',
							'default_value' => '',
							'label'         => esc_html__( 'Line Height', 'roslyn' ),
							'parent'        => $row_page_subtitle_styles_2,
							'args'          => array(
								'suffix' => 'px'
							)
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_subtitle_text_transform',
							'default_value' => '',
							'label'         => esc_html__( 'Text Transform', 'roslyn' ),
							'options'       => roslyn_elated_get_text_transform_array(),
							'parent'        => $row_page_subtitle_styles_2
						)
					);
		
				$row_page_subtitle_styles_3 = roslyn_elated_add_admin_row(
					array(
						'name'   => 'row_page_subtitle_styles_3',
						'parent' => $group_page_subtitle_styles,
						'next'   => true
					)
				);
		
					roslyn_elated_add_admin_field(
						array(
							'type'          => 'fontsimple',
							'name'          => 'page_subtitle_google_fonts',
							'default_value' => '-1',
							'label'         => esc_html__( 'Font Family', 'roslyn' ),
							'parent'        => $row_page_subtitle_styles_3
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_subtitle_font_style',
							'default_value' => '',
							'label'         => esc_html__( 'Font Style', 'roslyn' ),
							'options'       => roslyn_elated_get_font_style_array(),
							'parent'        => $row_page_subtitle_styles_3
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_subtitle_font_weight',
							'default_value' => '',
							'label'         => esc_html__( 'Font Weight', 'roslyn' ),
							'options'       => roslyn_elated_get_font_weight_array(),
							'parent'        => $row_page_subtitle_styles_3
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_subtitle_letter_spacing',
							'default_value' => '',
							'label'         => esc_html__( 'Letter Spacing', 'roslyn' ),
							'args'          => array(
								'suffix' => 'px'
							),
							'parent'        => $row_page_subtitle_styles_3
						)
					);
		
		/***************** Additional Title Typography Layout - start *****************/
		
		do_action( 'roslyn_elated_additional_title_typography_options_map', $panel_typography );
		
		/***************** Additional Title Typography Layout - end *****************/
    }

	add_action( 'roslyn_elated_options_map', 'roslyn_elated_title_options_map', 4);
}