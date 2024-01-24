<?php

if ( ! function_exists( 'roslyn_news_get_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function roslyn_news_get_template_part( $template, $module, $slug = '', $params = array() ) {
		//HTML Content from template
		$html          = '';
		$template_path = ROSLYN_NEWS_MODULES_PATH . '/' . $module;
		
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

if ( ! function_exists( 'roslyn_news_get_shortcode_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $shortcode name of the shortcode folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function roslyn_news_get_shortcode_module_template_part( $template, $shortcode, $slug = '', $params = array() ) {
		//HTML Content from template
		$html          = '';
		$template_path = ROSLYN_NEWS_SHORTCODES_PATH . '/' . $shortcode;
		
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

if ( ! function_exists( 'roslyn_news_get_shortcode_inner_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function roslyn_news_get_shortcode_inner_template_part( $template, $slug = '', $params = array() ) {
		//HTML Content from template
		$html          = '';
		$template_path = ROSLYN_NEWS_SHORTCODES_PATH . '/templates/parts';
		
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

if ( ! function_exists( 'roslyn_news_get_filtered_params' ) ) {
	/**
	 * Function that returns associative array without prefix.
	 * This function is used for block shortcodes (prefix_param -> param)
	 *
	 * @param $params array which need to be filtered
	 * @param $prefix string part of key that need to be removed
	 *
	 * @return array
	 */
	function roslyn_news_get_filtered_params( $params, $prefix ) {
		$params_filtered = array();
		
		foreach ( $params as $key => $value ) {
			$new_key                     = substr( $key, strlen( $prefix ) + 1 );
			$params_filtered[ $new_key ] = $value;
		}
		
		return $params_filtered;
	}
}

if ( ! function_exists( 'roslyn_news_update_post_count_views' ) ) {
	function roslyn_news_update_post_count_views() {
		$post_ID = get_the_ID();
		
		if ( is_singular( 'post' ) ) {
			if ( isset( $_COOKIE[ 'eltdf-post-views_' . $post_ID ] ) ) {
				return;
			} else {
				$count = get_post_meta( $post_ID, 'eltdf_count_post_views_meta', true );
				if ( $count === '' ) {
					update_post_meta( $post_ID, 'eltdf_count_post_views_meta', 1 );
					setcookie( 'eltdf-post-views_' . $post_ID, $post_ID, time() * 20, '/' );
				} else {
					$count ++;
					update_post_meta( $post_ID, 'eltdf_count_post_views_meta', $count );
					setcookie( 'eltdf-post-views_' . $post_ID, $post_ID, time() * 20, '/' );
				}
			}
		}
	}
	
	add_action( 'wp', 'roslyn_news_update_post_count_views' );
}

if ( ! function_exists( 'roslyn_news_get_post_count_views' ) ) {
	function roslyn_news_get_post_count_views( $post_ID = '' ) {
		if ( $post_ID == '' ) {
			$post_ID = get_the_ID();
		}
		
		$count = get_post_meta( $post_ID, 'eltdf_count_post_views_meta', true );
		
		if ( $count === '' ) {
			update_post_meta( $post_ID, 'eltdf_count_post_views_meta', '0' );
			
			return 0;
		}
		
		return $count;
	}
}

if ( ! function_exists( 'roslyn_news_get_post_categories' ) ) {
	/**
	 * Function that returns associative array of post categories,
	 * where key is category id and value is category name
	 * @return array
	 */
	function roslyn_news_get_post_categories($disable_category = false) {
		$vc_array        = $post_categories = array();
		$vc_array['all'] = esc_html__( 'All Categories', 'roslyn-news' );

		if ($disable_category) {
			$vc_array['no']  = esc_html__( 'Disable Category', 'roslyn-news' );
		}
		$post_categories = get_categories( array(
			'hide_empty' => 0
		) );

		if ( ! empty( $post_categories ) ) {
			foreach ( $post_categories as $cat ) {
				$vc_array[ $cat->slug ] = $cat->name;
			}
		}

		return $vc_array;
	}
}