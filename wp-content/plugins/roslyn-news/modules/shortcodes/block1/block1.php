<?php

namespace RoslynNews\CPT\Shortcodes\Block1;

use RoslynNews\Lib;

class Block1 extends Lib\NewsShortcodes {
	private $base;
	private $css_class;
	private $shortcode_title;
	private $icon_class;
	
	function __construct() {
		$this->base            = 'eltdf_block1';
		$this->css_class       = 'eltdf-block1';
		$this->shortcode_title = esc_html__( 'Block 1', 'roslyn-news' );
		$this->icon_class      = 'block1';
		
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
			'display_categories'         => 'yes',
			'display_date'               => 'yes',
			'date_format'                => 'published',
			'display_like'               => 'no',
			'display_comments'           => 'no',
			'display_share'              => 'no',
			'display_hot_trending_icons' => 'no',
			'display_excerpt'            => 'yes',
			'excerpt_length'             => '20'
		);
		
		return $default_atts;
	}
	
	public function getDefaultFeaturedParams() {
		$featured_atts = array(
			'featured_title_tag'                  => 'h2',
			'featured_image_size'                 => 'full',
			'featured_custom_image_width'         => '',
			'featured_custom_image_height'        => '',
			'featured_display_categories'         => 'yes',
			'featured_display_date'               => 'yes',
			'featured_date_format'                => 'published',
			'featured_display_like'               => 'yes',
			'featured_display_comments'           => 'yes',
			'featured_display_share'              => 'no',
			'featured_display_hot_trending_icons' => 'no'
		);
		
		return $featured_atts;
	}
	
	public function render( $atts, $content = null ) {
		$default_atts  = $this->getDefaultParams();
		$featured_atts = $this->getDefaultFeaturedParams();
		
		$params          = shortcode_atts( $default_atts, $atts );
		$featured_params = shortcode_atts( $featured_atts, $atts );
		$featured_params = roslyn_news_get_filtered_params( $featured_params, 'featured' );
		
		$html = '';
		
		if ( $atts['post_number'] == '1' ) {
			//Get HTML from template
			$html .= roslyn_news_get_shortcode_module_template_part( 'templates/layout7-template', 'layout7', '', $featured_params );
		} else {
			//Get HTML from template
			$html .= roslyn_news_get_shortcode_module_template_part( 'templates/layout3-template', 'layout3', '', $params );
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
			'featured_display_excerpt',
			'featured_excerpt_length',
			'featured_display_author',
			'featured_display_share',
			'featured_display_views'
		);
		
		$params_post_item_excluded = array(
			'display_author',
			'display_author_style',
			'featured_display_share',
			'display_share',
			'display_button',
			'display_views'
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
}