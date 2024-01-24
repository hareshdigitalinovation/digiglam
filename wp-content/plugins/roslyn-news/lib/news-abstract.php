<?php

namespace RoslynNews\Lib;

/**
 * Interface ShortcodeInterface
 */
abstract class NewsShortcodes {
	
	private $base;
	private $css_class;
	private $shortcode_title;
	private $icon_class;
	
	function __construct( $base = '', $css_class = '', $shortcode_title = '', $icon_class = '' ) {
		$this->base            = $base;
		$this->css_class       = $css_class;
		$this->shortcode_title = $shortcode_title;
		$this->icon_class      = $icon_class;
		
		//Category filter
		add_filter( 'vc_autocomplete_' . $this->base . '_category_name_callback', array( &$this, 'newsShortcodesCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Category render
		add_filter( 'vc_autocomplete_' . $this->base . '_category_name_render', array( &$this, 'newsShortcodesCategoryAutocompleteRender', ), 10, 1 );
		
		//Author filter
		add_filter( 'vc_autocomplete_' . $this->base . '_author_id_callback', array( &$this, 'newsShortcodesAuthorAutocompleteSuggester', ), 10, 1 );
		
		//Author render
		add_filter( 'vc_autocomplete_' . $this->base . '_author_id_render', array( &$this, 'newsShortcodesAuthorAutocompleteRender', ), 10, 1 );
		
		//Tag filter
		add_filter( 'vc_autocomplete_' . $this->base . '_tag_callback', array( &$this, 'newsShortcodesTagAutocompleteSuggester', ), 10, 1 );
		
		//Tag render
		add_filter( 'vc_autocomplete_' . $this->base . '_tag_render', array( &$this, 'newsShortcodesTagAutocompleteRender', ), 10, 1 );

		//Post in ID filter
		add_filter( 'vc_autocomplete_' . $this->base . '_post_in_callback', array( &$this, 'postIdAutocompleteSuggester', ), 10, 1 );
		
		//Post in ID render
		add_filter( 'vc_autocomplete_' . $this->base . '_post_in_render', array( &$this, 'postIdAutocompleteRender', ), 10, 1 );
		
		//Post not in ID filter
		add_filter( 'vc_autocomplete_' . $this->base . '_post_not_in_callback', array( &$this, 'postIdAutocompleteSuggester', ), 10, 1 );
		
		//Post not in ID render
		add_filter( 'vc_autocomplete_' . $this->base . '_post_not_in_render', array( &$this, 'postIdAutocompleteRender', ), 10, 1 );
	}
	
	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	
	/**
	 * Returns default params for shortcode
	 * @return array
	 */
	public function getDefaultParams() {
		$params = array();
		
		return $params;
	}
	
	/**
	 * Returns default featured params for shortcode
	 * @return array
	 */
	public function getDefaultFeaturedParams() {
		$params = array();
		
		return $params;
	}
	
	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map( array(
				"name"                      => $this->shortcode_title,
				"base"                      => $this->base,
				"category"                  => esc_html__( 'by ROSLYN NEWS', 'roslyn-news' ),
				"icon"                      => "icon-wpb-" . $this->icon_class . " extended-custom-news-icon",
				"allowed_container_element" => 'vc_row',
				"params"                    => $this->getShortcodeParams()
			) );
		}
	}
	
	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return string
	 */
	public function render( $atts, $content = null ) {
	}
	
	/**
	 * Renders shortcodes holder HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return html
	 */
	public function renderHolders( $atts, $content = null ) {
		//combine all params, shortcode defaults and shortcode sent
		$args = roslyn_news_get_shortcode_params_names( $this->getShortcodeParams() );
		
		$shortcode_default_params = array_merge( $this->getDefaultParams(), $this->getDefaultFeaturedParams() );
		$params_temp              = shortcode_atts( $args, $shortcode_default_params );
		
		$params = shortcode_atts( $params_temp, $atts );
		
		if ( $this->isVideoElement() ) {
			$params['only_videos'] = 'yes';
		}
		
		$params['query_result'] = $this->generatePostsQuery( $params );
		$holder_classes         = $this->getHolderClasses( $params );
		
		$html = '<div ' . roslyn_elated_get_class_attribute( $holder_classes ) . ' ' . esc_attr( $this->getNewsShortcodesHolderDataParams( $params ) ) . '>';
		
			if ( ! empty( $params['layout_title'] ) && $params['layout_title'] !== '' ) {
				$html .= $this->getLayoutTitle( $params );
			}
			
			if ( isset( $params['show_filter'] ) && $params['show_filter'] == 'yes' ) {
				$html .= $this->getFilter( $params );
			}
			
			$html .= $this->renderQuery( $params, $content );
			
			$html .= $this->getPaginationHtml( $params );
		
		$html .= '</div>'; // close eltdf-news-holder
		
		return $html;
	}
	
	/**
	 * Renders shortcodes query holder HTML
	 *
	 * @param $params array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return html
	 */
	public function renderQuery( $params, $content = null, $ajax_call = false ) {
		$html          = '';
		$inner_classes = $this->getHolderInnerClasses();
		$inner_data    = $this->getHolderInnerData( $params );
		
		$post_number = 0;
		
		if ( $params['query_result']->have_posts() ) {
			//if ajax call, then inner holder shouldn't be rendered again (ajax is added inside inner holder)
			if ( ! $ajax_call ) {
				$html .= '<div ' . roslyn_elated_get_class_attribute( $inner_classes ) . ' ' .  roslyn_elated_get_inline_attrs( $inner_data ) . '>';
			}
			
			while ( $params['query_result']->have_posts() ) : $params['query_result']->the_post();
				$post_number ++;
				$params['post_number'] = $post_number;
				
				//render shortcode templates and html depending on whether it is a block element or not
				//if block shortcode, divs around featured and non-featured posts addition
				if ( $this->isBlockElement() && $post_number == 1 ) {
					$html .= '<div class="eltdf-news-block-part-featured">';
						$html .= $this->render( $params );
					$html .= '</div>';
					$html .= '<div class="eltdf-news-block-part-non-featured">';
				} else {
					$html .= $this->render( $params );
				}
			endwhile;
			//close div after non-featured block element
			if ( $this->isBlockElement() ) {
				$html .= '</div>';  //closing eltdf-news-block-part-non-featured
			}
			if ( ! $ajax_call ) {
				$html .= '</div>'; //closing of eltdf-news-list-inner
			}
		} else {
			$html .= $this->errorMessage();
		}
		
		wp_reset_postdata();
		
		return $html;
	}
	
	/**
	 * Returns error message
	 *
	 * @return string
	 */
	public function errorMessage() {
		$errorMessage = esc_html__( 'Sorry, no posts matched your criteria.', 'roslyn-news' );;
		
		return $errorMessage;
	}
	
	/**
	 * Generates query array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function generatePostsQuery( $params ) {
		$queryResult = roslyn_news_get_query( $params );
		
		return $queryResult;
	}
	
	/**
	 * Returns additional holder classes for shortcode
	 * @return array
	 */
	public function getAdditionalHolderClasses($params) {
		$classes = array();
		
		return $classes;
	}
	
	/**
	 * Returns additional holder inner data for shortcode
	 * @return array
	 */
	public function getAdditionalHolderInnerData() {
		$data = array();
		
		return $data;
	}
	
	/**
	 * Returns if shortcode is Block or not
	 *
	 * @return boolean
	 */
	public function isBlockElement() {
		return false;
	}
	
	/**
	 * Returns if shortcode is Video Element or not
	 *
	 * @return boolean
	 */
	public function isVideoElement() {
		return false;
	}
	
	/**
	 * Returns if shortcode is Slider or not
	 *
	 * @return boolean
	 */
	public function isSlider() {
		return false;
	}
	
	/**
	 * Generates posts class string
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getHolderClasses( $params ) {
		$holder_classes   = array();
		$holder_classes[] = 'eltdf-news-holder';
		$holder_classes[] = $this->css_class;
		
		if ( isset( $params['extra_class_name'] ) && $params['extra_class_name'] !== '' ) {
			$holder_classes[] = $params['extra_class_name'];
		}
		
		if ( isset( $params['skin'] ) && $params['skin'] !== '' ) {
			$holder_classes[] = 'eltdf-news-skin-' . $params['skin'];
		}
		
		if ( isset( $params['block_proportion'] ) && $params['block_proportion'] !== '' ) {
			$holder_classes[] = 'eltdf-news-block-pp-' . $params['block_proportion'];
		}
		
		if ( $this->isPaginationEnabled( $params ) ) {
			$holder_classes[] = 'eltdf-news-pag-' . $params['pagination_type'];
		}
		
		if ( isset( $params['column_number'] ) && ! $this->isSlider() ) {
			if ( $params['column_number'] !== '' ) {
				$holder_classes[] = 'eltdf-news-columns-' . $params['column_number'];
			} else {
				$holder_classes[] = 'eltdf-news-columns-3';
			}
		}
		
		if ( isset( $params['space_between_items'] ) && $params['space_between_items'] !== '' ) {
			$holder_classes[] = 'eltdf-' . $params['space_between_items'] . '-space';
		}

		$additional_holder_classes = $this->getAdditionalHolderClasses($params);
		$holder_classes            = array_merge( $holder_classes, $additional_holder_classes );
		
		return implode( ' ', $holder_classes );
	}
	
	/**
	 * Generates holder inner class string
	 *
	 * @param $params
	 *
	 * @return string
	 */
	protected function getHolderInnerClasses() {
		$holder_inner_classes   = array();
		$holder_inner_classes[] = 'eltdf-news-list-inner';
		
		if ( ! $this->isSlider() ) {
			$holder_inner_classes[] = 'eltdf-outer-space';
		}
		
		if ( $this->isSlider() ) {
			$holder_inner_classes[] = 'eltdf-owl-slider';
		}
		
		return implode( ' ', $holder_inner_classes );
	}
	
	/**
	 * Generates holder inner data string
	 *
	 * @param $params
	 *
	 * @return string
	 */
	protected function getHolderInnerData( $params ) {
		$holder_inner_data = array();
		
		$holder_inner_data['data-number-of-items']        = isset( $params['number_of_visible_items'] ) && $params['number_of_visible_items'] !== '' ? $params['number_of_visible_items'] : '1';
		$holder_inner_data['data-enable-loop']            = isset( $params['slider_loop'] ) && ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$holder_inner_data['data-enable-autoplay']        = isset( $params['enable_autoplay'] ) && ! empty( $params['enable_autoplay'] ) ? $params['enable_autoplay'] : '';
		$holder_inner_data['data-slider-speed']           = isset( $params['slider_speed'] ) && ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$holder_inner_data['data-slider-speed-animation'] = isset( $params['slider_speed_animation'] ) && ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$holder_inner_data['data-enable-navigation']      = isset( $params['display_navigation'] ) && ! empty( $params['display_navigation'] ) ? $params['display_navigation'] : '';
		$holder_inner_data['data-enable-pagination']      = isset( $params['display_pagination'] ) && ! empty( $params['display_pagination'] ) ? $params['display_pagination'] : '';
		
		$additional_inner_data = $this->getAdditionalHolderInnerData();
		$holder_inner_data     = array_merge( $holder_inner_data, $additional_inner_data );
		
		return $holder_inner_data;
	}
	
	/**
	 * Generates posts class string
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getShortcodeParams( $exclude_options = array() ) {
		$params_general_excluded            = array();
		$params_featured_post_item_excluded = array();
		$params_post_item_excluded          = array();
		$params_pagination_excluded         = array();
		$params_navigation_excluded         = array();
		$params_pagination_array            = array();
		$params_navigation_array            = array();
		
		// General Options - start
		$params_general_array = roslyn_news_get_general_shortcode_params( $params_general_excluded );
		// General Options - end
		
		// Featured Post Item Options - start
		$params_featured_post_item_array = roslyn_news_get_featured_post_item_shortcode_params( $params_featured_post_item_excluded );
		// Featured Post Item Options - end
		
		// Post Item Options - start
		$params_post_item_array = roslyn_news_get_post_item_shortcode_params( $params_post_item_excluded );
		// Post Item Options - end
		
		//include/exclude params if shortcode is Slider
		if ( $this->isSlider() ) {
			// Slider Settings Options - start
			$params_navigation_array = roslyn_news_get_slider_shortcode_params( $params_navigation_excluded );
			// Slider Settings Options - end
		} else {
			// Pagination Options - start
			$params_pagination_array = roslyn_news_get_pagination_shortcode_params( $params_pagination_excluded );
			// Pagination Options - end
		}
		
		$params_array = array_merge(
			$params_general_array,
			$params_featured_post_item_array,
			$params_post_item_array,
			$params_pagination_array,
			$params_navigation_array
		);
		
		if ( is_array( $exclude_options ) && count( $exclude_options ) ) {
			foreach ( $exclude_options as $exclude_key ) {
				foreach ( $params_array as $params_item ) {
					if ( $exclude_key == $params_item['param_name'] ) {
						$key = array_search( $params_item, $params_array );
						unset( $params_array[ $key ] );
					}
				}
			}
		}
		
		return $params_array;
	}
	
	/**
	 * Filter post categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function newsShortcodesCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS category_title
                    FROM {$wpdb->terms} AS a
                    LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
                    WHERE b.taxonomy = 'category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['category_title'] ) > 0 ) ? esc_html__( 'Category', 'roslyn-news' ) . ': ' . $value['category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find post category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function newsShortcodesCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			
			$category = get_term_by( 'slug', $query, 'category' );
			if ( is_object( $category ) ) {
				
				$category_slug  = $category->slug;
				$category_title = $category->name;
				
				$category_title_display = '';
				if ( ! empty( $category_title ) ) {
					$category_title_display = esc_html__( 'Category', 'roslyn-news' ) . ': ' . $category_title;
				}
				
				$data          = array();
				$data['value'] = $category_slug;
				$data['label'] = $category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter posts tags
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function newsShortcodesTagAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS tag_title
                    FROM {$wpdb->terms} AS a
                    LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
                    WHERE b.taxonomy = 'post_tag' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['tag_title'] ) > 0 ) ? esc_html__( 'Tag', 'roslyn-news' ) . ': ' . $value['tag_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find post tag by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function newsShortcodesTagAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			
			$tag = get_term_by( 'slug', $query, 'post_tag' );
			if ( is_object( $tag ) ) {
				
				$tag_slug  = $tag->slug;
				$tag_title = $tag->name;
				
				$tag_title_display = '';
				if ( ! empty( $tag_title ) ) {
					$tag_title_display = esc_html__( 'Tag', 'roslyn-news' ) . ': ' . $tag_title;
				}
				
				$data          = array();
				$data['value'] = $tag_slug;
				$data['label'] = $tag_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter posts authors
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function newsShortcodesAuthorAutocompleteSuggester( $query ) {
		global $wpdb;
		
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.id AS ID, a.user_nicename as user_nicename
                    FROM {$wpdb->users} AS a WHERE a.user_nicename LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['ID'];
				$data['label'] = ( ( strlen( $value['user_nicename'] ) > 0 ) ? esc_html__( 'Author', 'roslyn-news' ) . ': ' . $value['user_nicename'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find posts author by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function newsShortcodesAuthorAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		
		if ( ! empty( $query ) ) {
			$author = get_user_by( 'ID', $query, 'user_nicename' );
			
			if ( is_object( $author ) ) {
				$author_id            = $author->id;
				$author_user_nicename = $author->user_nicename;
				
				$author_display = '';
				if ( ! empty( $author_user_nicename ) ) {
					$author_display = esc_html__( 'Author', 'roslyn-news' ) . ': ' . $author_user_nicename;
				}
				
				$data          = array();
				$data['value'] = $author_id;
				$data['label'] = $author_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter posts by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function postIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_id         = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
                    FROM {$wpdb->posts} 
                    WHERE post_type = 'post' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $post_id > 0 ? $post_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'roslyn-news' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'roslyn-news' ) . ': ' . $value['title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find posts by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function postIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		
		if ( ! empty( $query ) ) {
			$post = get_post( (int) $query );
			
			if ( ! is_wp_error( $post ) ) {
				$post_id    = $post->ID;
				$post_title = $post->post_title;
				
				$post_title_display = '';
				if ( ! empty( $post_title ) ) {
					$post_title_display = ' - ' . esc_html__( 'Title', 'roslyn-news' ) . ': ' . $post_title;
				}
				
				$post_id_display = esc_html__( 'Id', 'roslyn-news' ) . ': ' . $post_id;
				
				$data          = array();
				$data['value'] = $post_id;
				$data['label'] = $post_id_display . $post_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Generates Data Params for News Shortcodes holder
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getNewsShortcodesHolderDataParams( $params ) {
		$data_params_string = roslyn_news_get_holder_data_params( $params, $this->base );
		
		return $data_params_string;
	}
	
	/**
	 * Generates true/false for pagination
	 *
	 * @param $params
	 *
	 * @return boolean
	 */
	private function isPaginationEnabled( $params ) {
		return ( isset( $params['display_pagination'] ) && isset( $params['pagination_type'] ) && $params['display_pagination'] == 'yes' );
	}
	
	/**
	 * Generates pagination html
	 *
	 * @param $params
	 *
	 * @return string-html
	 */
	private function getPaginationHtml( $params ) {
		$html = '';
		
		if ( $this->isPaginationEnabled( $params ) && $params['query_result']->max_num_pages > 1 ) {
			$html .= roslyn_news_get_shortcode_inner_template_part( 'pagination/' . $params['pagination_type'], '', $params );
		}
		
		return $html;
	}
	
	/**
	 * Generates filter html
	 *
	 * @param $params
	 *
	 * @return string-html
	 */
	private function getFilter( $params ) {
		$filter_params = array();
		$filter_array  = array();
		
		switch ( $params['filter_by'] ) {
			case 'category':
				$terms = array();
				if ( $params['category_name'] !== '' ) {
					$categories = explode( ',', $params['category_name'] );
					
					foreach ( $categories as $category ) {
						$terms[] = get_category_by_slug( $category );
					}
				} else {
					$terms = get_categories();
				}
				
				$filter_array[] = array(
					'name' => esc_html__( 'All', 'roslyn-news' ),
					'slug' => $params['category_name']
				);
				
				foreach ( $terms as $term ) {
					if ( $term->count > 0 ) {
						$filter_array[] = array( 'name' => $term->name, 'slug' => $term->slug );
					}
				}
				
				break;
			case 'tag':
				$terms = array();
				if ( $params['tag'] !== '' ) {
					$tags = explode( ',', $params['tag'] );
					
					foreach ( $tags as $tag ) {
						$terms[] = get_term_by( 'slug', $tag, 'post_tag' );
					}
				} else {
					$terms = get_terms( array( 'taxonomy' => 'post_tag' ) );
				}
				
				$filter_array[] = array( 'name' => esc_html__( 'All', 'roslyn-news' ), 'slug' => $params['tag'] );
				
				foreach ( $terms as $term ) {
					if ( $term->count > 0 ) {
						$filter_array[] = array( 'name' => $term->name, 'slug' => $term->slug );
					}
				}
				
				break;
		}
		
		$filter_params['filter_array'] = $filter_array;
		$filter_params['filter_by']    = $params['filter_by'];
		
		$html = '';
		
		if ( is_array( $filter_array ) && count( $filter_array ) ) {
			$html .= roslyn_news_get_shortcode_inner_template_part( 'filter', '', $filter_params );
		}
		
		return $html;
	}
	
	/**
	 * Generates Layout Title html
	 *
	 * @param $params
	 *
	 * @return string-html
	 */
	private function getLayoutTitle( $params ) {
		$layout_title_html = '';
		$title_tag         = 'h3';
		
		if ( $params['layout_title_tag'] !== '' ) {
			$title_tag = $params['layout_title_tag'];
		}
		
		$layout_title_html .= '<div class="eltdf-news-list-title-holder">';
			$layout_title_html .= '<' . $title_tag . ' class="eltdf-news-layout-title">';
				$layout_title_html .= esc_html( $params['layout_title'] );
			$layout_title_html .= '</' . $title_tag . '>';
		$layout_title_html .= '</div>'; //closing of eltdf-news-list-title-holder
		
		return $layout_title_html;
	}
}