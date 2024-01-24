<?php

namespace RoslynNews\CPT\Shortcodes\PostCarousel1;

use RoslynNews\Lib;

class PostCarousel1 extends Lib\NewsShortcodes {
	private $base;
	private $css_class;
	private $shortcode_title;
	private $icon_class;
	
	function __construct() {
		$this->base            = 'eltdf_post_carousel1';
		$this->css_class       = 'eltdf-post-carousel1';
		$this->shortcode_title = esc_html__( 'Post Carousel 1', 'roslyn-news' );
		$this->icon_class      = 'post-carousel1';
		
		parent::__construct( $this->base, $this->css_class, $this->shortcode_title, $this->icon_class );
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function getDefaultParams() {
		$default_atts = array(
			'title_tag'                  => 'h2',
			'image_size'                 => 'full',
			'display_categories'         => 'yes',
			'display_date'               => 'yes',
			'date_format'                => 'difference',
			'display_excerpt'            => 'no',
			'excerpt_length'             => '',
			'display_like'               => 'yes',
			'display_comments'           => 'yes',
			'display_button'             => 'no',
			'display_share'              => 'no',
			'display_author_style'       => 'yes',
			'display_hot_trending_icons' => 'no',
			'content_padding'            => '',
		);
		
		return $default_atts;
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = $this->getDefaultParams();
		$params       = shortcode_atts( $default_atts, $atts );
		
		if ( $params['image_size'] === 'custom' ) {
			$params['image_size'] = 'full';
		}
		
		//Get HTML from template
		$html = roslyn_news_get_shortcode_module_template_part( 'templates/layout2-template', 'layout2', '', $params );
		
		return $html;
	}
	
	public function getAdditionalHolderInnerData() {
		$data['data-slider-animate-in']  = 'fadeIn';
		$data['data-slider-animate-out'] = 'fadeOut';
		
		return $data;
	}
	
	public function getShortcodeParams( $exclude_options = array() ) {
		$params_general_excluded = array(
			'column_number',
			'space_between_items',
			'block_proportion',
			'show_filter',
			'filter_by',
			'layout_title',
			'layout_title_tag'
		);
		
		$params_post_item_excluded = array(
			'custom_image_width',
			'custom_image_height',
			'display_author',
			'display_views',
			'display_button',
			'display_share'
		);
		
		$params_navigation_excluded = array(
			'number_of_visible_items'
		);

		$custom_params = array(
			array(
				'type'        => 'textfield',
				'param_name'  => 'content_padding',
				'heading'     => esc_html__( 'Content Padding', 'roslyn-core' ),
				'description' => esc_html__( 'Please insert padding in format top right bottom left. You can use px or %', 'roslyn-core' ),
				'group'       => esc_html__( 'General', 'roslyn-news' ),
				'save_always' => 'true'
			)
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
			$custom_params,
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