<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * roslyn_elated_header_meta hook
	 *
	 * @see roslyn_elated_header_meta() - hooked with 10
	 * @see roslyn_elated_user_scalable_meta - hooked with 10
	 * @see roslyn_core_set_open_graph_meta - hooked with 10
	 */
	do_action( 'roslyn_elated_header_meta' );
	
	wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php
	/**
	 * roslyn_elated_after_body_tag hook
	 *
	 * @see roslyn_elated_get_side_area() - hooked with 10
	 * @see roslyn_elated_smooth_page_transitions() - hooked with 10
	 */
	do_action( 'roslyn_elated_after_body_tag' ); ?>

    <div class="eltdf-wrapper">
        <div class="eltdf-wrapper-inner">
            <?php
            /**
             * roslyn_elated_after_wrapper_inner hook
             *
             * @see roslyn_elated_get_header() - hooked with 10
             * @see roslyn_elated_get_mobile_header() - hooked with 20
             * @see roslyn_elated_back_to_top_button() - hooked with 30
             * @see roslyn_elated_get_header_minimal_full_screen_menu() - hooked with 40
             * @see roslyn_elated_get_header_bottom_navigation() - hooked with 40
             */
            do_action( 'roslyn_elated_after_wrapper_inner' ); ?>
	        
            <div class="eltdf-content" <?php roslyn_elated_content_elem_style_attr(); ?>>
                <div class="eltdf-content-inner">