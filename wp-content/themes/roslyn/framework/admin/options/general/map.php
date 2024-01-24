<?php

if ( ! function_exists( 'roslyn_elated_general_options_map' ) ) {
	/**
	 * General options page
	 */
	function roslyn_elated_general_options_map() {
		
		roslyn_elated_add_admin_page(
			array(
				'slug'  => '',
				'title' => esc_html__( 'General', 'roslyn' ),
				'icon'  => 'fa fa-institution'
			)
		);
		
		$panel_design_style = roslyn_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_design_style',
				'title' => esc_html__( 'Design Style', 'roslyn' )
			)
		);

        roslyn_elated_add_admin_field(
            array(
                'name'          => 'enable_google_fonts',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__( 'Enable Google Fonts', 'roslyn' ),
                'parent'        => $panel_design_style
            )
        );

        $google_fonts_container = roslyn_elated_add_admin_container(
            array(
                'parent'          => $panel_design_style,
                'name'            => 'google_fonts_container',
                'dependency' => array(
                    'hide' => array(
                        'enable_google_fonts'  => 'no'
                    )
                )
            )
        );
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'google_fonts',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Google Font Family', 'roslyn' ),
				'description'   => esc_html__( 'Choose a default Google font for your site', 'roslyn' ),
				'parent'        => $google_fonts_container
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'additional_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Additional Google Fonts', 'roslyn' ),
				'parent'        => $google_fonts_container
			)
		);
		
		$additional_google_fonts_container = roslyn_elated_add_admin_container(
			array(
				'parent'          => $google_fonts_container,
				'name'            => 'additional_google_fonts_container',
				'dependency' => array(
					'show' => array(
						'additional_google_fonts'  => 'yes'
					)
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font1',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'roslyn' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'roslyn' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font2',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'roslyn' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'roslyn' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font3',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'roslyn' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'roslyn' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font4',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'roslyn' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'roslyn' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font5',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'roslyn' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'roslyn' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'google_font_weight',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Style & Weight', 'roslyn' ),
				'description'   => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'roslyn' ),
				'parent'        => $google_fonts_container,
				'options'       => array(
					'100'  => esc_html__( '100 Thin', 'roslyn' ),
					'100i' => esc_html__( '100 Thin Italic', 'roslyn' ),
					'200'  => esc_html__( '200 Extra-Light', 'roslyn' ),
					'200i' => esc_html__( '200 Extra-Light Italic', 'roslyn' ),
					'300'  => esc_html__( '300 Light', 'roslyn' ),
					'300i' => esc_html__( '300 Light Italic', 'roslyn' ),
					'400'  => esc_html__( '400 Regular', 'roslyn' ),
					'400i' => esc_html__( '400 Regular Italic', 'roslyn' ),
					'500'  => esc_html__( '500 Medium', 'roslyn' ),
					'500i' => esc_html__( '500 Medium Italic', 'roslyn' ),
					'600'  => esc_html__( '600 Semi-Bold', 'roslyn' ),
					'600i' => esc_html__( '600 Semi-Bold Italic', 'roslyn' ),
					'700'  => esc_html__( '700 Bold', 'roslyn' ),
					'700i' => esc_html__( '700 Bold Italic', 'roslyn' ),
					'800'  => esc_html__( '800 Extra-Bold', 'roslyn' ),
					'800i' => esc_html__( '800 Extra-Bold Italic', 'roslyn' ),
					'900'  => esc_html__( '900 Ultra-Bold', 'roslyn' ),
					'900i' => esc_html__( '900 Ultra-Bold Italic', 'roslyn' )
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'google_font_subset',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Subset', 'roslyn' ),
				'description'   => esc_html__( 'Choose a default Google font subsets for your site', 'roslyn' ),
				'parent'        => $google_fonts_container,
				'options'       => array(
					'latin'        => esc_html__( 'Latin', 'roslyn' ),
					'latin-ext'    => esc_html__( 'Latin Extended', 'roslyn' ),
					'cyrillic'     => esc_html__( 'Cyrillic', 'roslyn' ),
					'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'roslyn' ),
					'greek'        => esc_html__( 'Greek', 'roslyn' ),
					'greek-ext'    => esc_html__( 'Greek Extended', 'roslyn' ),
					'vietnamese'   => esc_html__( 'Vietnamese', 'roslyn' )
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'        => 'first_color',
				'type'        => 'color',
				'label'       => esc_html__( 'First Main Color', 'roslyn' ),
				'description' => esc_html__( 'Choose the most dominant theme color. Default color is #00bbb3', 'roslyn' ),
				'parent'      => $panel_design_style
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'        => 'page_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'roslyn' ),
				'description' => esc_html__( 'Choose the background color for page content. Default color is #ffffff', 'roslyn' ),
				'parent'      => $panel_design_style
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'        => 'page_background_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Page Background Image', 'roslyn' ),
				'description' => esc_html__( 'Choose the background image for page content', 'roslyn' ),
				'parent'      => $panel_design_style
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'page_background_image_repeat',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Page Background Image Repeat', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will set page background image as pattern in otherwise will be cover background image', 'roslyn' ),
				'parent'        => $panel_design_style
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'        => 'selection_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Text Selection Color', 'roslyn' ),
				'description' => esc_html__( 'Choose the color users see when selecting text', 'roslyn' ),
				'parent'      => $panel_design_style
			)
		);
		
		/***************** Passepartout Layout - begin **********************/
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'boxed',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Boxed Layout', 'roslyn' ),
				'parent'        => $panel_design_style
			)
		);
		
			$boxed_container = roslyn_elated_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'boxed_container',
					'dependency' => array(
						'show' => array(
							'boxed'  => 'yes'
						)
					)
				)
			);
		
				roslyn_elated_add_admin_field(
					array(
						'name'        => 'page_background_color_in_box',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'roslyn' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'roslyn' ),
						'parent'      => $boxed_container
					)
				);
				
				roslyn_elated_add_admin_field(
					array(
						'name'        => 'boxed_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'roslyn' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'roslyn' ),
						'parent'      => $boxed_container
					)
				);
				
				roslyn_elated_add_admin_field(
					array(
						'name'        => 'boxed_pattern_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'roslyn' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'roslyn' ),
						'parent'      => $boxed_container
					)
				);
				
				roslyn_elated_add_admin_field(
					array(
						'name'          => 'boxed_background_image_attachment',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'roslyn' ),
						'description'   => esc_html__( 'Choose background image attachment', 'roslyn' ),
						'parent'        => $boxed_container,
						'options'       => array(
							''       => esc_html__( 'Default', 'roslyn' ),
							'fixed'  => esc_html__( 'Fixed', 'roslyn' ),
							'scroll' => esc_html__( 'Scroll', 'roslyn' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'paspartu',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Passepartout', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'roslyn' ),
				'parent'        => $panel_design_style
			)
		);
		
			$paspartu_container = roslyn_elated_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'paspartu_container',
					'dependency' => array(
						'show' => array(
							'paspartu'  => 'yes'
						)
					)
				)
			);
		
				roslyn_elated_add_admin_field(
					array(
						'name'        => 'paspartu_color',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'roslyn' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'roslyn' ),
						'parent'      => $paspartu_container
					)
				);
				
				roslyn_elated_add_admin_field(
					array(
						'name'        => 'paspartu_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'roslyn' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'roslyn' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				roslyn_elated_add_admin_field(
					array(
						'name'        => 'paspartu_responsive_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'roslyn' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'roslyn' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				roslyn_elated_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'disable_top_paspartu',
						'label'         => esc_html__( 'Disable Top Passepartout', 'roslyn' )
					)
				);
		
				roslyn_elated_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'enable_fixed_paspartu',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'roslyn' ),
						'description' => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'roslyn' )
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Layout - begin **********************/
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'initial_content_width',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'roslyn' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'roslyn' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'eltdf-grid-1100' => esc_html__( '1100px - default', 'roslyn' ),
					'eltdf-grid-1300' => esc_html__( '1300px', 'roslyn' ),
					'eltdf-grid-1500' => esc_html__( '1500px', 'roslyn' ),
					'eltdf-grid-1200' => esc_html__( '1200px', 'roslyn' ),
					'eltdf-grid-1000' => esc_html__( '1000px', 'roslyn' ),
					'eltdf-grid-800'  => esc_html__( '800px', 'roslyn' )
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'preload_pattern_image',
				'type'          => 'image',
				'label'         => esc_html__( 'Preload Pattern Image', 'roslyn' ),
				'description'   => esc_html__( 'Choose preload pattern image to be displayed until images are loaded', 'roslyn' ),
				'parent'        => $panel_design_style
			)
		);
		
		/***************** Content Layout - end **********************/
		
		$panel_settings = roslyn_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_settings',
				'title' => esc_html__( 'Settings', 'roslyn' )
			)
		);
		
		/***************** Smooth Scroll Layout - begin **********************/
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'page_smooth_scroll',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Scroll', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'roslyn' ),
				'parent'        => $panel_settings
			)
		);
		
		/***************** Smooth Scroll Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'roslyn' ),
				'parent'        => $panel_settings
			)
		);
		
			$page_transitions_container = roslyn_elated_add_admin_container(
				array(
					'parent'          => $panel_settings,
					'name'            => 'page_transitions_container',
					'dependency' => array(
						'show' => array(
							'smooth_page_transitions'  => 'yes'
						)
					)
				)
			);
		
				roslyn_elated_add_admin_field(
					array(
						'name'          => 'page_transition_preloader',
						'type'          => 'yesno',
						'default_value' => 'no',
						'label'         => esc_html__( 'Enable Preloading Animation', 'roslyn' ),
						'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'roslyn' ),
						'parent'        => $page_transitions_container
					)
				);
				
				$page_transition_preloader_container = roslyn_elated_add_admin_container(
					array(
						'parent'          => $page_transitions_container,
						'name'            => 'page_transition_preloader_container',
						'dependency' => array(
							'show' => array(
								'page_transition_preloader'  => 'yes'
							)
						)
					)
				);
				
					roslyn_elated_add_admin_field(
						array(
							'name'   => 'smooth_pt_bgnd_color',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'roslyn' ),
							'parent' => $page_transition_preloader_container
						)
					);
					
					$group_pt_spinner_animation = roslyn_elated_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation',
							'title'       => esc_html__( 'Loader Style', 'roslyn' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'roslyn' ),
							'parent'      => $page_transition_preloader_container
						)
					);
					
					$row_pt_spinner_animation = roslyn_elated_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation',
							'parent' => $group_pt_spinner_animation
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'type'          => 'selectsimple',
							'name'          => 'smooth_pt_spinner_type',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Type', 'roslyn' ),
							'parent'        => $row_pt_spinner_animation,
							'options'       => array(
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'roslyn' ),
								'rotate_line'           => esc_html__( 'Rotate Line', 'roslyn' ),
								'pulse'                 => esc_html__( 'Pulse', 'roslyn' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'roslyn' ),
								'cube'                  => esc_html__( 'Cube', 'roslyn' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'roslyn' ),
								'stripes'               => esc_html__( 'Stripes', 'roslyn' ),
								'wave'                  => esc_html__( 'Wave', 'roslyn' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'roslyn' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'roslyn' ),
								'atom'                  => esc_html__( 'Atom', 'roslyn' ),
								'clock'                 => esc_html__( 'Clock', 'roslyn' ),
								'mitosis'               => esc_html__( 'Mitosis', 'roslyn' ),
								'lines'                 => esc_html__( 'Lines', 'roslyn' ),
								'fussion'               => esc_html__( 'Fussion', 'roslyn' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'roslyn' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'roslyn' )
							)
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'smooth_pt_spinner_color',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Color', 'roslyn' ),
							'parent'        => $row_pt_spinner_animation
						)
					);
					
					roslyn_elated_add_admin_field(
						array(
							'name'          => 'page_transition_fadeout',
							'type'          => 'yesno',
							'default_value' => 'no',
							'label'         => esc_html__( 'Enable Fade Out Animation', 'roslyn' ),
							'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'roslyn' ),
							'parent'        => $page_transitions_container
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'show_back_button',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show "Back To Top Button"', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will display a Back to Top button on every page', 'roslyn' ),
				'parent'        => $panel_settings
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'responsiveness',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Responsiveness', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will make all pages responsive', 'roslyn' ),
				'parent'        => $panel_settings
			)
		);
		
		$panel_custom_code = roslyn_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_custom_code',
				'title' => esc_html__( 'Custom Code', 'roslyn' )
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'        => 'custom_js',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom JS', 'roslyn' ),
				'description' => esc_html__( 'Enter your custom Javascript here', 'roslyn' ),
				'parent'      => $panel_custom_code
			)
		);
		
		$panel_google_api = roslyn_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => esc_html__( 'Google API', 'roslyn' )
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => esc_html__( 'Google Maps Api Key', 'roslyn' ),
				'description' => esc_html__( 'Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'roslyn' ),
				'parent'      => $panel_google_api
			)
		);
	}
	
	add_action( 'roslyn_elated_options_map', 'roslyn_elated_general_options_map', 1 );
}

if ( ! function_exists( 'roslyn_elated_page_general_style' ) ) {
	/**
	 * Function that prints page general inline styles
	 */
	function roslyn_elated_page_general_style( $style ) {
		$current_style = '';
		$page_id       = roslyn_elated_get_page_id();
		$class_prefix  = roslyn_elated_get_unique_page_class( $page_id );
		
		$boxed_background_style = array();
		
		$boxed_page_background_color = roslyn_elated_get_meta_field_intersect( 'page_background_color_in_box', $page_id );
		if ( ! empty( $boxed_page_background_color ) ) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}
		
		$boxed_page_background_image = roslyn_elated_get_meta_field_intersect( 'boxed_background_image', $page_id );
		if ( ! empty( $boxed_page_background_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_image ) . ')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat']   = 'no-repeat';
		}
		
		$boxed_page_background_pattern_image = roslyn_elated_get_meta_field_intersect( 'boxed_pattern_background_image', $page_id );
		if ( ! empty( $boxed_page_background_pattern_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_pattern_image ) . ')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat']   = 'repeat';
		}
		
		$boxed_page_background_attachment = roslyn_elated_get_meta_field_intersect( 'boxed_background_image_attachment', $page_id );
		if ( ! empty( $boxed_page_background_attachment ) ) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}
		
		$boxed_background_selector = $class_prefix . '.eltdf-boxed .eltdf-wrapper';
		
		if ( ! empty( $boxed_background_style ) ) {
			$current_style .= roslyn_elated_dynamic_css( $boxed_background_selector, $boxed_background_style );
		}
		
		$paspartu_style     = array();
		$paspartu_res_style = array();
		$paspartu_res_start = '@media only screen and (max-width: 1024px) {';
		$paspartu_res_end   = '}';
		
		$paspartu_header_selector                = array(
			'.eltdf-paspartu-enabled .eltdf-page-header .eltdf-fixed-wrapper.fixed',
			'.eltdf-paspartu-enabled .eltdf-sticky-header',
			'.eltdf-paspartu-enabled .eltdf-mobile-header.mobile-header-appear .eltdf-mobile-header-inner'
		);
		$paspartu_header_appear_selector         = array(
			'.eltdf-paspartu-enabled.eltdf-fixed-paspartu-enabled .eltdf-page-header .eltdf-fixed-wrapper.fixed',
			'.eltdf-paspartu-enabled.eltdf-fixed-paspartu-enabled .eltdf-sticky-header.header-appear',
			'.eltdf-paspartu-enabled.eltdf-fixed-paspartu-enabled .eltdf-mobile-header.mobile-header-appear .eltdf-mobile-header-inner'
		);
		
		$paspartu_header_style                   = array();
		$paspartu_header_appear_style            = array();
		$paspartu_header_responsive_style        = array();
		$paspartu_header_appear_responsive_style = array();
		
		$paspartu_color = roslyn_elated_get_meta_field_intersect( 'paspartu_color', $page_id );
		if ( ! empty( $paspartu_color ) ) {
			$paspartu_style['background-color'] = $paspartu_color;
		}
		
		$paspartu_width = roslyn_elated_get_meta_field_intersect( 'paspartu_width', $page_id );
		if ( $paspartu_width !== '' ) {
			if ( roslyn_elated_string_ends_with( $paspartu_width, '%' ) || roslyn_elated_string_ends_with( $paspartu_width, 'px' ) ) {
				$paspartu_style['padding'] = $paspartu_width;
				
				$paspartu_clean_width      = roslyn_elated_string_ends_with( $paspartu_width, '%' ) ? roslyn_elated_filter_suffix( $paspartu_width, '%' ) : roslyn_elated_filter_suffix( $paspartu_width, 'px' );
				$paspartu_clean_width_mark = roslyn_elated_string_ends_with( $paspartu_width, '%' ) ? '%' : 'px';
				
				$paspartu_header_style['left']              = $paspartu_width;
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width;
			} else {
				$paspartu_style['padding'] = $paspartu_width . 'px';
				
				$paspartu_header_style['left']              = $paspartu_width . 'px';
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_width ) . 'px)';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width . 'px';
			}
		}
		
		$paspartu_selector = $class_prefix . '.eltdf-paspartu-enabled .eltdf-wrapper';
		
		if ( ! empty( $paspartu_style ) ) {
			$current_style .= roslyn_elated_dynamic_css( $paspartu_selector, $paspartu_style );
		}
		
		if ( ! empty( $paspartu_header_style ) ) {
			$current_style .= roslyn_elated_dynamic_css( $paspartu_header_selector, $paspartu_header_style );
			$current_style .= roslyn_elated_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_style );
		}
		
		$paspartu_responsive_width = roslyn_elated_get_meta_field_intersect( 'paspartu_responsive_width', $page_id );
		if ( $paspartu_responsive_width !== '' ) {
			if ( roslyn_elated_string_ends_with( $paspartu_responsive_width, '%' ) || roslyn_elated_string_ends_with( $paspartu_responsive_width, 'px' ) ) {
				$paspartu_res_style['padding'] = $paspartu_responsive_width;
				
				$paspartu_clean_width      = roslyn_elated_string_ends_with( $paspartu_responsive_width, '%' ) ? roslyn_elated_filter_suffix( $paspartu_responsive_width, '%' ) : roslyn_elated_filter_suffix( $paspartu_responsive_width, 'px' );
				$paspartu_clean_width_mark = roslyn_elated_string_ends_with( $paspartu_responsive_width, '%' ) ? '%' : 'px';
				
				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width;
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width;
			} else {
				$paspartu_res_style['padding'] = $paspartu_responsive_width . 'px';
				
				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width . 'px';
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_responsive_width ) . 'px)';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width . 'px';
			}
		}
		
		if ( ! empty( $paspartu_res_style ) ) {
			$current_style .= $paspartu_res_start . roslyn_elated_dynamic_css( $paspartu_selector, $paspartu_res_style ) . $paspartu_res_end;
		}
		
		if ( ! empty( $paspartu_header_responsive_style ) ) {
			$current_style .= $paspartu_res_start . roslyn_elated_dynamic_css( $paspartu_header_selector, $paspartu_header_responsive_style ) . $paspartu_res_end;
			$current_style .= $paspartu_res_start . roslyn_elated_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_responsive_style ) . $paspartu_res_end;
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'roslyn_elated_add_page_custom_style', 'roslyn_elated_page_general_style' );
}