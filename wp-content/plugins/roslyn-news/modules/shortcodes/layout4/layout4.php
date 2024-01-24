<?php

namespace RoslynNews\CPT\Shortcodes\Layout4;

use RoslynNews\Lib;

class Layout4 extends Lib\NewsShortcodes {
	private $base;
	private $css_class;
	private $shortcode_title;
	private $icon_class;
	
	function __construct() {
		$this->base            = 'eltdf_layout4';
		$this->css_class       = 'eltdf-layout4';
		$this->shortcode_title = esc_html__( 'Layout 4', 'roslyn-news' );
		$this->icon_class      = 'layout4';
		
		parent::__construct( $this->base, $this->css_class, $this->shortcode_title, $this->icon_class );
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function getDefaultParams() {
		$default_atts = array(
			'title_tag'                  => 'h3',
			'image_size'                 => 'full',
			'display_categories'         => 'yes',
			'display_date'               => 'yes',
			'date_format'                => 'published',
			'display_excerpt'            => 'yes',
			'excerpt_length'             => '',
			'display_like'               => 'no',
			'display_comments'           => 'no',
			'display_author'             => 'yes',
			'display_hot_trending_icons' => 'no',
			'display_share'              => 'yes',
			'space_between_items'        => 'normal'
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
		$html = roslyn_news_get_shortcode_module_template_part( 'templates/layout4-template', 'layout4', '', $params );
		
		return $html;
	}
	
	public function getShortcodeParams( $exclude_options = array() ) {
		$params_general_excluded = array(
			'block_proportion'
		);
		
		$params_post_item_excluded = array(
			'custom_image_width',
			'custom_image_height',
			'display_views',
			'display_author_style',
			'display_button'
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
}