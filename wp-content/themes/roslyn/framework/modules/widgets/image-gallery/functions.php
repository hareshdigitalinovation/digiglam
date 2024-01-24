<?php

if ( ! function_exists( 'roslyn_elated_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function roslyn_elated_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'RoslynElatedImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'roslyn_elated_register_widgets', 'roslyn_elated_register_image_gallery_widget' );
}