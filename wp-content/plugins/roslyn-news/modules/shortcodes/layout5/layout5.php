<?php

namespace RoslynNews\CPT\Shortcodes\layout5;

use RoslynNews\Lib;

class Layout5 extends Lib\NewsShortcodes {
	private $base;
	private $css_class;
	private $shortcode_title;
	private $icon_class;
	
	function __construct() {
		$this->base            = 'eltdf_layout5';
		$this->css_class       = 'eltdf-layout5';
		$this->shortcode_title = esc_html__( 'Layout 5', 'roslyn-news' );
		$this->icon_class      = 'layout5';
		
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
			'custom_image_width'         => '',
			'custom_image_height'        => '',
			'display_categories'         => 'yes',
			'display_date'               => 'yes',
			'date_format'                => 'published',
			'display_excerpt'            => 'no',
			'display_button'             => 'no',
			'display_share'              => 'no',
			'display_comments'           => 'no',
			'display_like'               => 'no',
			'excerpt_length'             => '',
			'display_author'             => 'yes',
			'display_author_style'       => '',
			'display_hot_trending_icons' => 'no',
			'alignment'                  => 'left'
		);

		return $default_atts;
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = $this->getDefaultParams();
		$params       = shortcode_atts( $default_atts, $atts );
		
		//Get HTML from template
		$html = roslyn_news_get_shortcode_module_template_part( 'templates/layout5-template', 'layout5', '', $params );
		
		return $html;
	}
	
	public function getShortcodeParams( $exclude_options = array() ) {
		$params_general_excluded = array(
			'block_proportion'
		);
		
		$params_post_item_excluded = array(
			'display_views',
			'display_button',
			'display_comments',
			'display_like',
			'display_share',
		);
		
		// General Options - start
		$params_general_array = roslyn_news_get_general_shortcode_params( $params_general_excluded );
		// General Options - end
		
		// Post Item Options - start
		$params_post_item_array = roslyn_news_get_post_item_shortcode_params( $params_post_item_excluded );
		// Post Item Options - end

		$custom_params = array(
			array(
				'type'       => 'dropdown',
				'param_name' => 'alignment',
				'heading'    => esc_html__( 'Content Alignment', 'roslyn-news' ),
				'value'      => array(
					esc_html__( 'Left', 'roslyn-core' ) => 'left',
					esc_html__( 'Center', 'roslyn-core' )  => 'center'
				),
				'save_always' => 'true',
				'group'      => esc_html__( 'Post Item', 'roslyn-news' )
			)
		);
		
		// Pagination Options - start
		$params_pagination_array = roslyn_news_get_pagination_shortcode_params();
		// Pagination Options - end
		
		$params_array = array_merge(
			$params_general_array,
			$params_post_item_array,
			$custom_params,
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