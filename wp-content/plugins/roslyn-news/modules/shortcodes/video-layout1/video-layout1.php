<?php

namespace RoslynNews\CPT\Shortcodes\VideoLayout1;

use RoslynNews\Lib;

class VideoLayout1 extends Lib\NewsShortcodes {
	private $base;
	private $css_class;
	private $shortcode_title;
	private $icon_class;
	
	function __construct() {
		$this->base            = 'eltdf_video_layout1';
		$this->css_class       = 'eltdf-video-layout1';
		$this->shortcode_title = esc_html__( 'Video Layout 1', 'roslyn-news' );
		$this->icon_class      = 'video-layout1';
		
		parent::__construct( $this->base, $this->css_class, $this->shortcode_title, $this->icon_class );
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function getDefaultParams() {
		$default_atts = array(
			'title_tag'                  => 'h4',
			'image_size'                 => 'full',
			'custom_image_width'         => '',
			'custom_image_height'        => '',
			'display_excerpt'            => 'no',
			'excerpt_length'             => '',
			'display_categories'         => 'yes',
			'display_date'               => 'yes',
			'date_format'                => '',
			'display_like'               => 'no',
			'display_comments'           => 'no',
			'display_share'              => 'no',
			'display_hot_trending_icons' => 'no'
		);
		
		return $default_atts;
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = $this->getDefaultParams();
		$params       = shortcode_atts( $default_atts, $atts );
		
		$post_id                  = get_the_ID();
		$params['video_type']     = get_post_meta( $post_id, "eltdf_video_type_meta", true );
		$params['has_video_link'] = get_post_meta( $post_id, "eltdf_post_video_custom_meta", true ) !== '' || get_post_meta( $post_id, "eltdf_post_video_link_meta", true ) !== '';
		
		if ( $params['video_type'] == 'social_networks' ) {
			$params['video_link'] = get_post_meta( $post_id, "eltdf_post_video_link_meta", true );
		} else {
			$params['video_link']  = get_post_meta( $post_id, "eltdf_post_video_custom_meta", true );
			$params['video_link']  .= '?iframe=true'; //added afterwards to get metadata properly
			$params['video_image'] = get_post_meta( $post_id, "eltdf_post_video_image_meta", true);
		}
		
		$params['rand'] = rand( 0, 1000 );
		
		$html = '';
		
		if ( $params['has_video_link'] ) {
			//Get HTML from template
			$html = roslyn_news_get_shortcode_module_template_part( 'templates/video-layout1-template', 'video-layout1', '', $params );
		}
		
		return $html;
	}
	
	public function getShortcodeParams( $exclude_options = array() ) {
		$params_general_excluded = array(
			'block_proportion'
		);
		
		$params_post_item_excluded = array(
			'display_author',
			'display_like',
			'display_comments',
			'display_author',
			'display_author_style',
			'display_button',
			'display_hot_trending_icons',
			'display_share',
			'display_views'
		);
		
		// General Options - start
		$params_general_array = roslyn_news_get_general_shortcode_params( $params_general_excluded );
		// General Options - end
		
		// Post Item Options - start
		$params_post_item_array = roslyn_news_get_post_item_shortcode_params( $params_post_item_excluded );
		// Post Item Options - end
		
		// Pagination Options - start
		$params_pagination_array = roslyn_news_get_pagination_shortcode_params();
		// Pagination Options - end
		
		$params_array = array_merge(
			$params_general_array,
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
	
	public function isVideoElement() {
		return true;
	}
}