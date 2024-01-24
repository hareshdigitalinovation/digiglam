<?php

if ( ! function_exists( 'roslyn_elated_register_blog_standard_template_file' ) ) {
	/**
	 * Function that register blog standard template
	 */
	function roslyn_elated_register_blog_standard_template_file( $templates ) {
		$templates['blog-standard'] = esc_html__( 'Blog: Standard', 'roslyn' );
		
		return $templates;
	}
	
	add_filter( 'roslyn_elated_register_blog_templates', 'roslyn_elated_register_blog_standard_template_file' );
}

if ( ! function_exists( 'roslyn_elated_set_blog_standard_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function roslyn_elated_set_blog_standard_type_global_option( $options ) {
		$options['standard'] = esc_html__( 'Blog: Standard', 'roslyn' );
		
		return $options;
	}
	
	add_filter( 'roslyn_elated_blog_list_type_global_option', 'roslyn_elated_set_blog_standard_type_global_option' );
}