<?php

if ( ! function_exists( 'roslyn_elated_disable_behaviors_for_header_bottom' ) ) {
	/**
	 * This function is used to disable sticky header functions that perform processing variables their used in js for this header type
	 */
	function roslyn_elated_disable_behaviors_for_header_bottom( $allow_behavior ) {
		return false;
	}
	
	if ( roslyn_elated_check_is_header_type_enabled( 'header-bottom', roslyn_elated_get_page_id() ) ) {
		add_filter( 'roslyn_elated_allow_sticky_header_behavior', 'roslyn_elated_disable_behaviors_for_header_bottom' );
		add_filter( 'roslyn_elated_allow_content_boxed_layout', 'roslyn_elated_disable_behaviors_for_header_bottom' );

        remove_action('roslyn_elated_after_wrapper_inner', 'roslyn_elated_get_header');
        add_action('roslyn_elated_before_main_content', 'roslyn_elated_get_header');
	}
}