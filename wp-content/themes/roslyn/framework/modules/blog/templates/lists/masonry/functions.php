<?php

if ( ! function_exists( 'roslyn_elated_register_blog_masonry_template_file' ) ) {
	/**
	 * Function that register blog masonry template
	 */
	function roslyn_elated_register_blog_masonry_template_file( $templates ) {
		$templates['blog-masonry'] = esc_html__( 'Blog: Masonry', 'roslyn' );
		
		return $templates;
	}
	
	add_filter( 'roslyn_elated_register_blog_templates', 'roslyn_elated_register_blog_masonry_template_file' );
}

if ( ! function_exists( 'roslyn_elated_set_blog_masonry_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function roslyn_elated_set_blog_masonry_type_global_option( $options ) {
		$options['masonry'] = esc_html__( 'Blog: Masonry', 'roslyn' );
		
		return $options;
	}
	
	add_filter( 'roslyn_elated_blog_list_type_global_option', 'roslyn_elated_set_blog_masonry_type_global_option' );
}