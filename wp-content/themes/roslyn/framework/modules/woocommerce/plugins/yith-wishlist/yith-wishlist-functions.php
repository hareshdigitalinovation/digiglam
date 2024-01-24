<?php

if(!function_exists('roslyn_elated_is_yith_wishlist_installed')) {
	function roslyn_elated_is_yith_wishlist_installed() {
		return defined('YITH_WCWL');
	}
}

if(!function_exists('roslyn_elated_woocommerce_wishlist_shortcode')) {
	function roslyn_elated_woocommerce_wishlist_shortcode() {

		if(roslyn_elated_is_yith_wishlist_installed()) {
			echo do_shortcode('[yith_wcwl_add_to_wishlist]');
		}
	}
}

if(!function_exists('eltdf_product_ajax_wishlist')) {
	function eltdf_product_ajax_wishlist(){

		$data = array(
			'wishlist_count_products' => class_exists('YITH_WCWL') ? yith_wcwl_count_products() : 0
		);
		wp_send_json($data); exit;
	}

	add_action('wp_ajax_eltdf_product_ajax_wishlist', 'eltdf_product_ajax_wishlist');
	add_action('wp_ajax_nopriv_eltdf_product_ajax_wishlist', 'eltdf_product_ajax_wishlist');
}

if ( ! function_exists( 'roslyn_elated_register_yith_wishlist_widget' ) ) {
	/**
	 * Function that register yith wishlist widget
	 */
	function roslyn_elated_register_yith_wishlist_widget( $widgets ) {
		$widgets[] = 'RoslynElatedYithWishlist';

		return $widgets;
	}

	add_filter( 'roslyn_elated_filter_register_widgets', 'roslyn_elated_register_yith_wishlist_widget' );
}
