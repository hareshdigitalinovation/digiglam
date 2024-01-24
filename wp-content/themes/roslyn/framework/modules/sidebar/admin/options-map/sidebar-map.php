<?php

if ( ! function_exists( 'roslyn_elated_sidebar_options_map' ) ) {
	function roslyn_elated_sidebar_options_map() {
		
		roslyn_elated_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'roslyn' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = roslyn_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'roslyn' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		roslyn_elated_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'roslyn' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'roslyn' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => roslyn_elated_get_custom_sidebars_options()
		) );
		
		$roslyn_custom_sidebars = roslyn_elated_get_custom_sidebars();
		if ( is_array( $roslyn_custom_sidebars ) && count( $roslyn_custom_sidebars ) > 0 ) {
			roslyn_elated_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'roslyn' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'roslyn' ),
				'parent'      => $sidebar_panel,
				'options'     => $roslyn_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'roslyn_elated_options_map', 'roslyn_elated_sidebar_options_map', 6 );
}