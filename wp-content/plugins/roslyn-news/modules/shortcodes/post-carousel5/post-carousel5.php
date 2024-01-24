<?php

namespace RoslynNews\CPT\Shortcodes\PostCarousel5;

use RoslynNews\Lib;

class PostCarousel5 extends Lib\NewsShortcodes {
	private $base;
	private $css_class;
	private $shortcode_title;
	private $icon_class;
	
	function __construct() {
		$this->base            = 'eltdf_post_carousel5';
		$this->css_class       = 'eltdf-post-carousel5';
		$this->shortcode_title = esc_html__( 'Post Carousel 5', 'roslyn-news' );
		$this->icon_class      = 'post-carousel5';
		
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
			'display_categories'         => 'yes',
			'display_date'               => 'yes',
			'date_format'                => 'published',
			'display_excerpt'            => 'no',
			'excerpt_length'             => '',
			'display_like'               => 'no',
			'display_comments'           => 'no',
			'display_button'             => 'no',
			'display_share'              => 'no',
			'display_author_style'       => 'no',
			'display_hot_trending_icons' => 'no',
			'alignment'                  => 'left',
			'content_padding'            => '',
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

	public function getAdditionalHolderInnerData() {
		$data['data-enable-navigation']  = 'no';
		
		return $data;
	}

	
	public function getShortcodeParams( $exclude_options = array() ) {
		$params_general_excluded = array(
			'column_number',
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
			'display_author_style',
			'display_views',
			'display_button',
			'display_share'
		);
		
		$params_navigation_excluded = array(
			'display_navigation'
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

		$custom_params = array(
			array(
				'type'        => 'textfield',
				'param_name'  => 'content_padding',
				'heading'     => esc_html__( 'Content Padding', 'roslyn-core' ),
				'description' => esc_html__( 'Please insert padding in format top right bottom left. You can use px or %', 'roslyn-core' ),
				'group'       => esc_html__( 'General', 'roslyn-news' ),
				'save_always' => 'true'
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'carousel_title',
				'heading'     => esc_html__( 'Carousel Title', 'roslyn-core' ),
				'group'       => esc_html__( 'General', 'roslyn-news' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'carousel_button_link',
				'heading'     => esc_html__( 'Carousel Button Link', 'roslyn-core' ),
				'group'       => esc_html__( 'General', 'roslyn-news' ),
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'carousel_button_text',
				'heading'     => esc_html__( 'Carousel Button Text', 'roslyn-core' ),
				'group'       => esc_html__( 'General', 'roslyn-news' ),
			)
		);
		
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

	public function renderQuery( $params, $content = null, $ajax_call = false ) {
		$html          = '';
		$inner_classes = $this->getHolderInnerClasses();
		$inner_data    = $this->getHolderInnerData( $params );
		
		$post_number = 0;

		$html .= '<div class="eltdf-post-carousel5-holder"><div class="eltdf-post-carousel5-title-holder"><span>'.$params['carousel_title'].'</span><a class="eltdf-btn eltdf-btn-normal eltdf-btn-simple" href="'.$params['carousel_button_link'].'"><span class="eltdf-btn-text">'.$params['carousel_button_text'].'</span><span class="eltdf-btn-line"></span></a></div></div>';

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
	 * Returns additional holder classes for shortcode
	 * @return array
	 */
	public function getAdditionalHolderClasses($params) {
		$classes = array();

		if(!empty($params['carousel_title'])) {
			$classes[] = 'eltdf-post-carousel5-with-title';
		}
		
		return $classes;
	}
}