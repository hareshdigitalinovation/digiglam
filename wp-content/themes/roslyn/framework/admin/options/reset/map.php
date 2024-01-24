<?php

if ( ! function_exists( 'roslyn_elated_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function roslyn_elated_reset_options_map() {
		
		roslyn_elated_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'roslyn' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = roslyn_elated_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'roslyn' )
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'roslyn' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'roslyn' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'roslyn_elated_options_map', 'roslyn_elated_reset_options_map', 100 );
}