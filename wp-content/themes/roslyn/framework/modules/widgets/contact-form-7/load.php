<?php

if ( roslyn_elated_contact_form_7_installed() ) {
	include_once ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/contact-form-7/contact-form-7.php';
	
	add_filter( 'roslyn_elated_register_widgets', 'roslyn_elated_register_cf7_widget' );
}

if ( ! function_exists( 'roslyn_elated_register_cf7_widget' ) ) {
	/**
	 * Function that register cf7 widget
	 */
	function roslyn_elated_register_cf7_widget( $widgets ) {
		$widgets[] = 'RoslynElatedContactForm7Widget';
		
		return $widgets;
	}
}