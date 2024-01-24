<?php

if ( ! function_exists( 'roslyn_news_blog_single_types' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function roslyn_news_blog_single_types( $single ) {
		global $post;
		
		if ( roslyn_news_theme_installed() ) {
			$post_template = roslyn_elated_get_meta_field_intersect( 'news_post_template', get_the_ID() );
			
			if ( $post->post_type == 'post' && $post_template !== '' ) {
				return ROSLYN_NEWS_BLOG_PATH . '/news-single.php';
			}
		}
		
		return $single;
	}
	
	add_filter( 'single_template', 'roslyn_news_blog_single_types' );
}

foreach ( glob( ROSLYN_NEWS_BLOG_PATH . '/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'roslyn_news_get_blog_part' ) ) {
	/**
	 * Loads blog template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function roslyn_news_get_blog_part( $template, $holder, $slug = '', $params = array() ) {
		//HTML Content from template
		$html          = '';
		$template_path = ROSLYN_NEWS_BLOG_PATH . '/' . $holder;
		
		$temp = $template_path . '/' . $template;
		
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}
		
		$template = '';
		
		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";
				
				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}
		
		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}
		
		return $html;
	}
}

if ( ! function_exists( 'roslyn_news_get_holder_params_blog' ) ) {
	/**
	 * Function which return holder class and holder inner class for blog pages
	 */
	function roslyn_news_get_holder_params_blog() {
		/**
		 * Available parameters for holder params
		 * -holder
		 * -inner
		 */
		return apply_filters( 'roslyn_news_blog_holder_params', $params = array() );
	}
}

if ( ! function_exists( 'roslyn_news_include_blog_helper_functions' ) ) {
	/**
	 * Function which include blog helper function file
	 *
	 * @param $post_template - post_template for module
	 */
	function roslyn_news_include_blog_helper_functions( $post_template ) {
		include_once ROSLYN_NEWS_BLOG_PATH . '/single/' . $post_template . '/types/helper.php';
	}
}

if ( ! function_exists( 'roslyn_news_get_blog_single' ) ) {
	function roslyn_news_get_blog_single( $post_template ) {
		$sidebar_layout  = roslyn_elated_sidebar_layout();
		$grid_space_meta = roslyn_elated_get_meta_field_intersect( 'blog_single_grid_space', roslyn_elated_get_page_id() );
		
		$holder_classes   = array();
		$holder_classes[] = $sidebar_layout !== 'no-sidebar' ? 'eltdf-content-has-sidebar' : '';
		$holder_classes[] = ! empty( $grid_space_meta ) ? 'eltdf-grid-' . $grid_space_meta . '-gutter' : 'eltdf-grid-large-gutter';
		
		$holder_classes   = apply_filters( 'roslyn_elated_blog_single_holder_classes', $holder_classes );
		
		$params = array(
			'holder_classes'      => implode( ' ', $holder_classes ),
			'sidebar_layout'      => $sidebar_layout,
			'blog_single_type'    => $post_template,
			'blog_single_classes' => 'eltdf-blog-single-' . $post_template
		);
		
		echo roslyn_news_get_blog_part( $post_template . '/holder', 'single', '', $params );
	}
}

if ( ! function_exists( 'roslyn_news_blog_single_top_part' ) ) {
	function roslyn_news_blog_single_top_part( $post_template ) {
		
		$params = array();
		/*
		 * Available parameters for template parts
		 * -image_size
		 * -title_tag
		 * -link_tag
		 * -quote_tag
		 * -share type
		 */
		$params['part_params'] = apply_filters( 'roslyn_elated_blog_part_params', array() );
		
		echo roslyn_news_get_blog_part( $post_template . '/top-part', 'single', '', $params );
	}
}

if ( ! function_exists( 'roslyn_news_blog_single_type' ) ) {
	/**
	 * Function which returns proper single post template
	 *
	 * @param $type string with name of list that is loaded
	 */
	function roslyn_news_blog_single_type( $blog_single_type ) {
		$params = array();
		
		$params['blog_single_type'] = $blog_single_type;
		/*
		 * Available parameters for info parts
		 * -related_posts_image_size
		 */
		$params['single_info_params'] = apply_filters( 'roslyn_elated_blog_single_info_params', array() );
		
		echo roslyn_news_get_blog_part( $blog_single_type . '/types/single', 'single', '', $params );
	}
}

if ( ! function_exists( 'roslyn_news_blog_get_single_post_format_html' ) ) {
	/**
	 * Function return all parts on single.php page
	 *
	 * @param $type - type of blog single layout
	 */
	function roslyn_news_blog_get_single_post_format_html( $blog_single_type ) {
		$post_format = roslyn_elated_return_post_format();
		
		$params = array();
		/*
		 * Available parameters for template parts
		 * -image_size
		 * -title_tag
		 * -link_tag
		 * -quote_tag
		 * -share type
		 */
		$params['part_params'] = apply_filters( 'roslyn_elated_blog_part_params', array() );
		
		echo roslyn_news_get_blog_part( $blog_single_type . '/types/' . $post_format, 'single', '', $params );
	}
}

if ( ! function_exists( 'roslyn_news_blog_single_default_inside_image' ) ) {
	function roslyn_news_blog_single_default_inside_image() {
		if ( is_single() ) {
			echo roslyn_news_get_blog_part( 'parts/post-info/hot-trending', 'templates', '', array(
				'display_hot_trending_icons' => 'yes',
				'display_hot_trending_text'  => true
			) );
		}
	}
	
	add_action( 'roslyn_elated_action_blog_inside_image_tag', 'roslyn_news_blog_single_default_inside_image' );
}