<?php
namespace RoslynCore\CPT\Shortcodes\PricingTable;

use RoslynCore\Lib;

class PricingTable implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_pricing_table';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Pricing Table', 'roslyn-core' ),
					'base'                    => $this->base,
					'as_parent'               => array( 'only' => 'eltdf_pricing_table_item' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by ROSLYN', 'roslyn-core' ),
					'icon'                    => 'icon-wpb-pricing-table extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'columns',
							'heading'     => esc_html__( 'Number of Columns', 'roslyn-core' ),
							'value'       => array(
								esc_html__( 'One', 'roslyn-core' )   => 'eltdf-one-column',
								esc_html__( 'Two', 'roslyn-core' )   => 'eltdf-two-columns',
								esc_html__( 'Three', 'roslyn-core' ) => 'eltdf-three-columns',
								esc_html__( 'Four', 'roslyn-core' )  => 'eltdf-four-columns',
								esc_html__( 'Five', 'roslyn-core' )  => 'eltdf-five-columns',
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'roslyn-core' ),
							'value'       => array_flip( roslyn_elated_get_space_between_items_array() ),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'columns'             => 'eltdf-two-columns',
			'space_between_items' => 'normal'
		);
		$params = shortcode_atts( $args, $atts );
		
		$holder_class = $this->getHolderClasses( $params, $args );
		
		$html = '<div class="eltdf-pricing-tables clearfix ' . esc_attr( $holder_class ) . '">';
			$html .= '<div class="eltdf-pt-wrapper eltdf-outer-space">';
				$html .= do_shortcode( $content );
			$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['columns'] ) ? $params['columns'] : $args['columns'];
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'eltdf-' . $params['space_between_items'] . '-space' : 'eltdf-' . $args['space_between_items'] . '-space';
		
		return implode( ' ', $holderClasses );
	}
}