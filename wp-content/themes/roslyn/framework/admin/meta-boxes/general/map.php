<?php

if ( ! function_exists( 'roslyn_elated_map_general_meta' ) ) {
	function roslyn_elated_map_general_meta() {
		
		$general_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'roslyn_elated_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'roslyn' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'roslyn' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'roslyn' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'roslyn' ),
				'parent'        => $general_meta_box
			)
		);
		
		$eltdf_content_padding_group = roslyn_elated_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Style', 'roslyn' ),
				'description' => esc_html__( 'Define styles for Content area', 'roslyn' ),
				'parent'      => $general_meta_box
			)
		);
		
			$eltdf_content_padding_row = roslyn_elated_add_admin_row(
				array(
					'name'   => 'eltdf_content_padding_row',
					'next'   => true,
					'parent' => $eltdf_content_padding_group
				)
			);
		
				roslyn_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_page_content_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Padding (e.g. 10px 5px 10px 5px)', 'roslyn' ),
						'parent' => $eltdf_content_padding_row,
					)
				);
				
				roslyn_elated_create_meta_box_field(
					array(
						'name'    => 'eltdf_page_content_padding_mobile',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Content Padding for mobile (e.g. 10px 5px 10px 5px)', 'roslyn' ),
						'parent'  => $eltdf_content_padding_row,
					)
				);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_page_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'roslyn' ),
				'description' => esc_html__( 'Choose background color for page content', 'roslyn' ),
				'parent'      => $general_meta_box
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_page_background_image_meta',
				'type'          => 'image',
				'label'         => esc_html__( 'Page Background Image', 'roslyn' ),
				'description'   => esc_html__( 'Choose background image for page content', 'roslyn' ),
				'parent'        => $general_meta_box
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_page_background_repeat_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Page Background Image Repeat', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will set page background image as pattern in otherwise will be cover background image', 'roslyn' ),
				'options'       => roslyn_elated_get_yes_no_select_array(),
				'parent'        => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'    => 'eltdf_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'roslyn' ),
				'parent'  => $general_meta_box,
				'options' => roslyn_elated_get_yes_no_select_array()
			)
		);
		
			$boxed_container_meta = roslyn_elated_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'dependency' => array(
						'hide' => array(
							'eltdf_boxed_meta'  => array('','no')
						)
					)
				)
			);
		
				roslyn_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'roslyn' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'roslyn' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				roslyn_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'roslyn' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'roslyn' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				roslyn_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'roslyn' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'roslyn' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				roslyn_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'roslyn' ),
						'description'   => esc_html__( 'Choose background image attachment', 'roslyn' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'roslyn' ),
							'fixed'  => esc_html__( 'Fixed', 'roslyn' ),
							'scroll' => esc_html__( 'Scroll', 'roslyn' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'roslyn' ),
				'parent'        => $general_meta_box,
				'options'       => roslyn_elated_get_yes_no_select_array(),
			)
		);
		
			$paspartu_container_meta = roslyn_elated_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'eltdf_paspartu_container_meta',
					'dependency' => array(
						'hide' => array(
							'eltdf_paspartu_meta'  => array('','no')
						)
					)
				)
			);
		
				roslyn_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'roslyn' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'roslyn' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				roslyn_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'roslyn' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'roslyn' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				roslyn_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'roslyn' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'roslyn' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				roslyn_elated_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'eltdf_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'roslyn' ),
						'options'       => roslyn_elated_get_yes_no_select_array(),
					)
				);
		
				roslyn_elated_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'eltdf_enable_fixed_paspartu_meta',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'roslyn' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'roslyn' ),
						'options'       => roslyn_elated_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Width Layout - begin **********************/
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'roslyn' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'roslyn' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'roslyn' ),
					'eltdf-grid-1100' => esc_html__( '1100px', 'roslyn' ),
                    'eltdf-grid-1500' => esc_html__( '1500px', 'roslyn' ),
					'eltdf-grid-1300' => esc_html__( '1300px', 'roslyn' ),
					'eltdf-grid-1200' => esc_html__( '1200px', 'roslyn' ),
					'eltdf-grid-1000' => esc_html__( '1000px', 'roslyn' ),
					'eltdf-grid-800'  => esc_html__( '800px', 'roslyn' )
				)
			)
		);
		
		/***************** Content Width Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'roslyn' ),
				'parent'        => $general_meta_box,
				'options'       => roslyn_elated_get_yes_no_select_array()
			)
		);
		
			$page_transitions_container_meta = roslyn_elated_add_admin_container(
				array(
					'parent'     => $general_meta_box,
					'name'       => 'page_transitions_container_meta',
					'dependency' => array(
						'hide' => array(
							'eltdf_smooth_page_transitions_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				roslyn_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'roslyn' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'roslyn' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => roslyn_elated_get_yes_no_select_array()
					)
				);
		
				$page_transition_preloader_container_meta = roslyn_elated_add_admin_container(
					array(
						'parent'     => $page_transitions_container_meta,
						'name'       => 'page_transition_preloader_container_meta',
						'dependency' => array(
							'hide' => array(
								'eltdf_page_transition_preloader_meta' => array( '', 'no' )
							)
						)
					)
				);
				
					roslyn_elated_create_meta_box_field(
						array(
							'name'   => 'eltdf_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'roslyn' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = roslyn_elated_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'roslyn' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'roslyn' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = roslyn_elated_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					roslyn_elated_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'eltdf_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'roslyn' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'roslyn' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'roslyn' ),
								'roslyn_spinner'        => esc_html__( 'Roslyn Spinner', 'roslyn' ),
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
					
					roslyn_elated_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'eltdf_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'roslyn' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);
					
					roslyn_elated_create_meta_box_field(
						array(
							'name'        => 'eltdf_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'roslyn' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'roslyn' ),
							'options'     => roslyn_elated_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'roslyn' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'roslyn' ),
				'parent'      => $general_meta_box,
				'options'     => roslyn_elated_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_elated_map_general_meta', 10 );
}

if ( ! function_exists( 'roslyn_elated_container_background_style' ) ) {
	/**
	 * Function that return container style
	 */
	function roslyn_elated_container_background_style( $style ) {
		$page_id      = roslyn_elated_get_page_id();
		$class_prefix = roslyn_elated_get_unique_page_class( $page_id, true );
		
		$container_selector = array(
			$class_prefix . ' .eltdf-content'
		);
		
		$container_class        = array();
		$page_background_color  = get_post_meta( $page_id, 'eltdf_page_background_color_meta', true );
		$page_background_image  = get_post_meta( $page_id, 'eltdf_page_background_image_meta', true );
		$page_background_repeat = get_post_meta( $page_id, 'eltdf_page_background_repeat_meta', true );
		
		if ( ! empty( $page_background_color ) ) {
			$container_class['background-color'] = $page_background_color;
		}
		
		if ( ! empty( $page_background_image ) ) {
			$container_class['background-image'] = 'url(' . esc_url( $page_background_image ) . ')';
			
			if ( $page_background_repeat === 'yes' ) {
				$container_class['background-repeat']   = 'repeat';
				$container_class['background-position'] = '0 0';
			} else {
				$container_class['background-repeat']   = 'no-repeat';
				$container_class['background-position'] = 'center 0';
				$container_class['background-size']     = 'cover';
			}
		}
		
		$current_style = roslyn_elated_dynamic_css( $container_selector, $container_class );
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'roslyn_elated_add_page_custom_style', 'roslyn_elated_container_background_style' );
}