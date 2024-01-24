<?php

if ( ! function_exists( 'roslyn_news_get_blog_holder_params' ) ) {
	/**
	 * Function that generates params for holders on blog templates
	 */
	function roslyn_news_get_blog_holder_params( $params ) {
		$params_list = array();
		
		$params_list['holder'] = 'eltdf-container';
		$params_list['inner']  = 'eltdf-container-inner clearfix';
		
		return $params_list;
	}
	
	add_filter( 'roslyn_news_blog_holder_params', 'roslyn_news_get_blog_holder_params' );
}
