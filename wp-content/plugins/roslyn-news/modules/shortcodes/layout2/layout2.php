<?php

namespace RoslynNews\CPT\Shortcodes\Layout2;

use RoslynNews\Lib;

class Layout2 extends Lib\NewsShortcodes {
	private $base;
	private $css_class;
	private $shortcode_title;
	private $icon_class;
	
	function __construct() {
		$this->base            = 'eltdf_layout2';
		$this->css_class       = 'eltdf-layout2';
		$this->shortcode_title = esc_html__( 'Layout 2', 'roslyn-news' );
		$this->icon_class      = 'layout2';
		
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
			'custom_image_width'         => '',
			'custom_image_height'        => '',
			'display_categories'         => 'yes',
			'display_date'               => 'yes',
			'date_format'                => 'published',
			'display_excerpt'            => 'no',
			'excerpt_length'             => '',
			'display_like'               => 'yes',
			'display_comments'           => 'yes',
			'display_button'             => 'yes',
			'display_author'             => 'yes',
			'display_author_style'       => '',
			'display_hot_trending_icons' => 'no',
			'display_share'              => 'yes',
			'button_type'                => 'simple',
			'alignment'                  => 'left',
			'bg_transparent'             => 'no',
			'content_padding'            => '',
			'content_width'              => '',
			'parallax'              	 => 'no',
		);

		return $default_atts;
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = $this->getDefaultParams();
		$params       = shortcode_atts( $default_atts, $atts );

		$params['content_styles'] = $this->getContentStyles( $params );
		$params['bg_styles'] = $this->getContentTransparency( $params );
		$params['holder_classes']    = $this->getHolderClasses( $params );
		$params['holder_data']       = $this->getHolderData( $params );

		//Get HTML from template
		$html = roslyn_news_get_shortcode_module_template_part( 'templates/layout2-template', 'layout2', '', $params );
		
		return $html;
	}

	private function getContentStyles( $params ) {
		$styles = array();

		if (!empty($params['alignment'])) {
			$styles[] = 'text-align: ' . $params['alignment'] . ';';
		}

		if ( $params['content_padding'] !== '' ) {
			$styles[] = 'padding: ' . $params['content_padding'].';';
		}

		if ( $params['content_width'] !== '' ) {
			$left = (100 - $params['content_width'])/2;

			$styles[] = 'width: ' . $params['content_width'].'%';
			$styles[] = 'left: ' .$left .'%';
		}

		return $styles;
	}

	private function getContentTransparency( $params ) {
		$style = '';

		if ($params['bg_transparent'] === 'yes'){
			$style = 'eltdf-ni-transparent';
		}

		return $style;
	}
	
	public function getShortcodeParams( $exclude_options = array() ) {
		$params_general_excluded = array(
			'block_proportion'
		);
		
		$params_post_item_excluded = array(
			'display_views'
		);
		
		// General Options - start
		$params_general_array = roslyn_news_get_general_shortcode_params( $params_general_excluded );
		// General Options - end
		
		// Post Item Options - start
		$params_post_item_array = roslyn_news_get_post_item_shortcode_params( $params_post_item_excluded );
		// Post Item Options - end

		$custom_params = array(
			array(
				'type'        => 'textfield',
				'param_name'  => 'content_width',
				'heading'     => esc_html__( 'Content Width (%)', 'roslyn-core' ),
				'description' => esc_html__( 'Please insert the without %', 'roslyn-core' ),
				'group'       => esc_html__( 'General', 'roslyn-news' ),
				'save_always' => 'true'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'content_padding',
				'heading'     => esc_html__( 'Content Padding', 'roslyn-core' ),
				'description' => esc_html__( 'Please insert padding in format top right bottom left. You can use px or %', 'roslyn-core' ),
				'group'       => esc_html__( 'General', 'roslyn-news' ),
				'save_always' => 'true'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'button_type',
				'heading'    => esc_html__( 'Button Type', 'roslyn-news' ),
				'value'      => array(
					esc_html__( 'Simple', 'roslyn-core' )  => 'simple',
					esc_html__( 'Outline', 'roslyn-core' ) => 'outline'
				),
				'group'      => esc_html__( 'Post Item', 'roslyn-news' ),
				'dependency'  => array( 'element' => 'display_button', 'value' =>  'yes'  ),
			),
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
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'bg_transparent',
				'heading'     => esc_html__( 'Background Transparency', 'roslyn-core' ),
				'value'       => array_flip( roslyn_elated_get_yes_no_select_array( false, false ) ),
				'save_always' => true,
				'group'      => esc_html__( 'Post Item', 'roslyn-news' )
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'parallax',
				'heading'     => esc_html__( 'Image parallax', 'roslyn-core' ),
				'value'      => array(
					esc_html__( 'No', 'roslyn-core' )  => 'no',
					esc_html__( 'Yes', 'roslyn-core' ) => 'yes'
				),
				'save_always' => true,
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

	private function getHolderClasses( $params ) {
		$holderClasses = array('');
		
		$holderClasses[] = ( $params['parallax'] ) == 'yes' ? 'eltdf-veh-parallax-layout' : '';
		
		return implode( ' ', $holderClasses );
	}

	private function getHolderData( $params ) {
		$data = array();

		$y_absolute = -200;
		$smoothness = 2; //1 is for linear, non-animated parallax

		if ( $params['parallax']  === 'yes' ) {
			$data['data-parallax'] = '{&quot;y&quot;: '.$y_absolute.', &quot;smoothness&quot;: '.$smoothness.'}';
		}
		
		return $data;
	}
}