<?php
namespace RoslynCore\CPT\Shortcodes\FullScreenImageSlider;

use RoslynCore\Lib;

class FullScreenImageSlider implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_full_screen_image_slider';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Full Screen Image Slider', 'roslyn-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by ROSLYN', 'roslyn-core' ),
					'as_parent'                 => array( 'only' => 'eltdf_full_screen_image_slider_item' ),
					'icon'                      => 'icon-wpb-full-screen-image-slider extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'js_view'                   => 'VcColumnView',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'roslyn-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'roslyn-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed',
							'heading'     => esc_html__( 'Slide Duration', 'roslyn-core' ),
							'description' => esc_html__( 'Default value is 5000 (ms)', 'roslyn-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed_animation',
							'heading'     => esc_html__( 'Slide Animation Duration', 'roslyn-core' ),
							'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'roslyn-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_navigation',
							'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'roslyn-core' ),
							'value'       => array_flip( roslyn_elated_get_yes_no_select_array( false, true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_pagination',
							'heading'     => esc_html__( 'Enable Slider Pagination', 'roslyn-core' ),
							'value'       => array_flip( roslyn_elated_get_yes_no_select_array( false, true ) ),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'            => '',
			'slider_speed'            => '6000',
			'slider_speed_animation'  => '1000',
			'slider_navigation'       => 'yes',
			'slider_pagination'       => 'yes'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['slider_data']    = $this->getSliderData( $params, $args );
		$params['content']        = $content;
		
		$html = roslyn_core_get_shortcode_module_template_part( 'templates/full-screen-image-slider', 'full-screen-image-slider', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getSliderData( $params, $args ) {
		$slider_data = array();
		
		$slider_data['data-number-of-items']             = '1';
		$slider_data['data-enable-loop']                 = 'yes';
		$slider_data['data-enable-autoplay']             = 'yes';
		$slider_data['data-enable-autoplay-hover-pause'] = 'yes';
		$slider_data['data-slider-padding']              = 'no';
		$slider_data['data-slider-speed']                = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : $args['slider_speed'];
		$slider_data['data-slider-speed-animation']      = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : $args['slider_speed_animation'];
		$slider_data['data-enable-navigation']           = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : $args['slider_navigation'];
		$slider_data['data-enable-pagination']           = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : $args['slider_pagination'];
		
		return $slider_data;
	}
}