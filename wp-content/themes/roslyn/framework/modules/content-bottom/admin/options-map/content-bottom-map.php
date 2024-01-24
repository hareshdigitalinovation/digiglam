<?php

if ( ! function_exists( 'roslyn_elated_content_bottom_options_map' ) ) {
	function roslyn_elated_content_bottom_options_map() {
		
		$panel_content_bottom = roslyn_elated_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_content_bottom',
				'title' => esc_html__( 'Content Bottom Area Style', 'roslyn' )
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'enable_content_bottom_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'roslyn' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'roslyn' ),
				'parent'        => $panel_content_bottom
			)
		);
		
		$enable_content_bottom_area_container = roslyn_elated_add_admin_container(
			array(
				'parent'          => $panel_content_bottom,
				'name'            => 'enable_content_bottom_area_container',
				'dependency' => array(
					'show' => array(
						'enable_content_bottom_area'  => 'yes'
					)
				)
			)
		);
		
		$roslyn_custom_sidebars = roslyn_elated_get_custom_sidebars();
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'selectblank',
				'name'          => 'content_bottom_sidebar_custom_display',
				'default_value' => '',
				'label'         => esc_html__( 'Widget Area to Display', 'roslyn' ),
				'description'   => esc_html__( 'Choose a Content Bottom widget area to display', 'roslyn' ),
				'options'       => $roslyn_custom_sidebars,
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'content_bottom_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Display in Grid', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will place Content Bottom in grid', 'roslyn' ),
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'content_bottom_background_color',
				'label'       => esc_html__( 'Background Color', 'roslyn' ),
				'description' => esc_html__( 'Choose a background color for Content Bottom area', 'roslyn' ),
				'parent'      => $enable_content_bottom_area_container
			)
		);
	}
	
	add_action( 'roslyn_elated_additional_page_options_map', 'roslyn_elated_content_bottom_options_map' );
}