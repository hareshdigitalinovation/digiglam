<?php

namespace RoslynNews\CPT\Shortcodes\PostCarousel3;

use RoslynNews\Lib;

class PostCarousel3 extends Lib\NewsShortcodes {
	private $base;
	private $css_class;
	private $shortcode_title;
	private $icon_class;
	
	function __construct() {
		$this->base            = 'eltdf_post_carousel3';
		$this->css_class       = 'eltdf-post-carousel3';
		$this->shortcode_title = esc_html__( 'Post Carousel 3', 'roslyn-news' );
		$this->icon_class      = 'post-carousel3';
		
		parent::__construct( $this->base, $this->css_class, $this->shortcode_title, $this->icon_class );
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function getDefaultParams() {
		$default_atts = array(
			'title_tag'                  => 'h3',
			'image_size'                 => 'portrait',
			'custom_image_width'         => '',
			'custom_image_height'        => '',
			'display_categories'         => 'yes',
			'display_date'               => 'yes',
			'date_format'                => 'published',
			'display_author'             => 'no',
			'display_author_style'       => '',
			'display_like'               => 'no',
			'display_comments'           => 'no',
			'display_share'              => 'no',
			'display_button'             => 'no',
			'display_excerpt'            => 'no',
			'display_hot_trending_icons' => 'no',
			'bg_transparent'             => 'no',
			'display_navigation'         => 'no',
			'display_pagination'         => 'no',
		);
		
		return $default_atts;
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = $this->getDefaultParams();
		$params       = shortcode_atts( $default_atts, $atts );
		
		//Get HTML from template
		$html = roslyn_news_get_shortcode_module_template_part( 'templates/layout8-template', 'layout8', '', $params );
		
		return $html;
	}
	
	public function getShortcodeParams( $exclude_options = array() ) {
		$params_general_excluded = array(
			'column_number',
			'space_between_items',
			'block_proportion',
			'show_filter',
			'filter_by',
			'layout_title',
			'layout_title_tag',
		);
		
		$params_post_item_excluded = array(
			'display_author',
			'display_author_style',
			'display_like',
			'display_comments',
			'display_share',
			'display_button',
			'display_excerpt',
			'display_hot_trending_icons',
			'display_views',
			'bg_transparent',
			'excerpt_length',
		);

		$params_navigation_excluded = array(
		);
		
		// General Options - start
		$params_general_array = roslyn_news_get_general_shortcode_params( $params_general_excluded );
		// General Options - end
		
		// Post Item Options - start
		$params_post_item_array = roslyn_news_get_post_item_shortcode_params( $params_post_item_excluded );
		// Post Item Options - end

		// Slider Settings Options - start
		$params_navigation_array = roslyn_news_get_slider_shortcode_params( $params_navigation_excluded );
		// Slider Settings Options - end
		
		$params_array = array_merge(
			$params_general_array,
			$params_post_item_array,
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
	
	public function isSlider() {
		return true;
	}
}