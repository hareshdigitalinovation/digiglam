<?php

if ( ! function_exists( 'roslyn_elated_register_widgets' ) ) {
	function roslyn_elated_register_widgets() {
		$widgets = apply_filters( 'roslyn_elated_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'roslyn_elated_register_widgets' );
}