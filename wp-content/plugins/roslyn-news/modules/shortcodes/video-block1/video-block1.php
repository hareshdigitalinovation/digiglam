<?php

namespace RoslynNews\CPT\Shortcodes\VideoBlock1;

use RoslynNews\Lib;

class VideoBlock1 extends Lib\NewsShortcodes {
	private $base;
	private $css_class;
	private $shortcode_title;
	private $icon_class;
	
	function __construct() {
		$this->base            = 'eltdf_video_block1';
		$this->css_class       = 'eltdf-video-block1';
		$this->shortcode_title = esc_html__( 'Video Block 1', 'roslyn-news' );
		$this->icon_class      = 'video-block1';
		
		parent::__construct( $this->base, $this->css_class, $this->shortcode_title, $this->icon_class );
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function getDefaultParams() {
		$default_atts = array(
			'title_tag'           => 'h4',
			'image_size'          => 'medium',
			'custom_image_width'  => '',
			'custom_image_height' => '',
			'display_date'        => 'no',
			'display_categories'  => 'no',
			'display_excerpt'     => 'no',
			'display_button'      => 'no',
			'date_format'         => 'published'
		);
		
		return $default_atts;
	}
	
	public function getDefaultFeaturedParams() {
		$featured_atts = array(
			'featured_title_tag'                  => 'h3',
			'featured_image_size'                 => 'full',
			'featured_custom_image_width'         => '',
			'featured_custom_image_height'        => '',
			'featured_display_excerpt'            => 'no',
			'featured_excerpt_length'             => '',
			'featured_display_categories'         => 'no',
			'featured_display_date'               => 'no',
			'featured_date_format'                => '',
			'featured_display_like'               => 'no',
			'featured_display_comments'           => 'no',
			'featured_display_share'              => 'no',
			'featured_display_hot_trending_icons' => 'no'
		);
		
		return $featured_atts;
	}
	
	public function render( $atts, $content = null ) {
		$featured_atts = $this->getDefaultFeaturedParams();
		$default_atts  = $this->getDefaultParams();
		
		$post_id         = get_the_ID();
		$params          = shortcode_atts( $default_atts, $atts );
		$featured_params = shortcode_atts( $featured_atts, $atts );
		$featured_params = roslyn_news_get_filtered_params( $featured_params, 'featured' );
		
		$featured_params['video_type']     = get_post_meta( $post_id , "eltdf_video_type_meta", true );
		$featured_params['has_video_link'] = get_post_meta( $post_id, "eltdf_post_video_custom_meta", true ) !== '' || get_post_meta( $post_id, "eltdf_post_video_link_meta", true ) !== '';
		
		if ( $featured_params['video_type'] == 'social_networks' ) {
			$featured_params['video_link'] = get_post_meta( $post_id, "eltdf_post_video_link_meta", true );
		} else {
			$featured_params['video_link']  = get_post_meta( $post_id, "eltdf_post_video_custom_meta", true );
			$featured_params['video_link']  .= '?iframe=true'; //added afterwards to get metadata properly
			$featured_params['video_image'] = get_post_meta( $post_id, "eltdf_post_video_image_meta", true);
		}
		
		$featured_params['rand'] = rand( 0, 1000 );
		$featured_params         = array_merge( $params, $featured_params );
		
		$html = '';
		
		if ( $atts['post_number'] == '1' && $featured_params['has_video_link'] ) {
			//Get HTML from template
			$html .= roslyn_news_get_shortcode_module_template_part( 'templates/video-layout1-template', 'video-layout1', '', $featured_params );
		} else {
			//Get HTML from template
			$html .= roslyn_news_get_shortcode_module_template_part( 'templates/video-layout1-template', 'video-layout1', '', $params );
		}
		
		return $html;
	}
	
	public function getShortcodeParams( $exclude_options = array() ) {
		$params_general_excluded = array(
			'column_number',
			'show_filter',
			'filter_by'
		);
		
		$params_featured_post_item_excluded = array (
			'featured_display_author',
			'featured_display_views',
			'featured_display_excerpt',
			'featured_display_date',
			'featured_display_like',
			'featured_display_comments',
			'featured_display_share',
			'featured_excerpt_length',
			'featured_display_categories',
			'featured_date_format',
			'featured_title_tag',
			'featured_display_hot_trending_icons'
		);
		
		$params_post_item_excluded = array(
			'display_excerpt',
			'excerpt_length',
			'display_categories',
			'display_author',
			'display_views',
			'display_like',
			'display_comments',
			'display_share',
			'display_date',
			'display_button',
			'display_author_style',
			'date_format',
			'display_hot_trending_icons'
		);
		
		// General Options - start
		$params_general_array = roslyn_news_get_general_shortcode_params( $params_general_excluded );
		// General Options - end
		
		// Featured Post Item Options - start
		$params_featured_post_item_array = roslyn_news_get_featured_post_item_shortcode_params( $params_featured_post_item_excluded );
		// Featured Post Item Options - end
		
		// Post Item Options - start
		$params_post_item_array = roslyn_news_get_post_item_shortcode_params( $params_post_item_excluded );
		// Post Item Options - end
		
		// Pagination Options - start
		$params_pagination_array = roslyn_news_get_pagination_shortcode_params();
		// Pagination Options - end
		
		$params_array = array_merge(
			$params_general_array,
			$params_featured_post_item_array,
			$params_post_item_array,
			$params_pagination_array
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
	
	public function isBlockElement() {
		return true;
	}
	
	public function isVideoElement() {
		return true;
	}
}