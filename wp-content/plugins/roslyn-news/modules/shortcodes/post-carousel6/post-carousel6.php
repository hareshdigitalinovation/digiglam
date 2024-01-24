<?php

namespace RoslynNews\CPT\Shortcodes\PostCarousel6;

use RoslynNews\Lib;

class PostCarousel6 extends Lib\NewsShortcodes {
	private $base;
	private $css_class;
	private $shortcode_title;
	private $icon_class;
	
	function __construct() {
		$this->base            = 'eltdf_post_carousel6';
		$this->css_class       = 'eltdf-post-carousel6';
		$this->shortcode_title = esc_html__( 'Post Carousel 6', 'roslyn-news' );
		$this->icon_class      = 'post-carousel6';
		
		parent::__construct( $this->base, $this->css_class, $this->shortcode_title, $this->icon_class );
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function getDefaultParams() {
		$default_atts = array(
			'title_tag'                  => 'h2',
			'image_size'                 => 'landscape',
			'custom_image_width'         => '',
			'custom_image_height'        => '',
			'display_categories'         => 'no',
			'display_date'               => 'no',
			'date_format'                => 'published',
			'display_author'             => 'yes',
			'display_author_style'       => '',
			'display_like'               => 'no',
			'display_comments'           => 'no',
			'display_share'              => 'no',
			'display_button'             => 'no',
			'display_excerpt'            => 'no',
			'display_hot_trending_icons' => 'no',
			'bg_transparent'             => 'no',
			'display_navigation'         => 'yes',
			'display_pagination'         => 'yes',
		);
		
		return $default_atts;
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = $this->getDefaultParams();
		$params       = shortcode_atts( $default_atts, $atts );
		
		//Get HTML from template
		$html = roslyn_news_get_shortcode_module_template_part( 'templates/layout2-template', 'layout2', '', $params );
		
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