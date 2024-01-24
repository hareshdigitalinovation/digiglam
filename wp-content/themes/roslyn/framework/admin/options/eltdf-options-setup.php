<?php

if ( ! function_exists( 'roslyn_elated_admin_map_init' ) ) {
	function roslyn_elated_admin_map_init() {
		do_action( 'roslyn_elated_before_options_map' );
		
		foreach ( glob( ELATED_FRAMEWORK_ROOT_DIR . '/admin/options/*/*.php' ) as $module_load ) {
			include_once $module_load;
		}
		
		do_action( 'roslyn_elated_options_map' );
		
		do_action( 'roslyn_elated_after_options_map' );
	}
	
	add_action( 'after_setup_theme', 'roslyn_elated_admin_map_init', 1 );
}