<?php

class RoslynElatedSeparatorWidget extends RoslynElatedWidget {
	public function __construct() {
		parent::__construct(
			'eltdf_separator_widget',
			esc_html__( 'Roslyn Separator Widget', 'roslyn' ),
			array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'roslyn' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'roslyn' ),
				'options' => array(
					'normal'     => esc_html__( 'Normal', 'roslyn' ),
					'full-width' => esc_html__( 'Full Width', 'roslyn' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'position',
				'title'   => esc_html__( 'Position', 'roslyn' ),
				'options' => array(
					'center' => esc_html__( 'Center', 'roslyn' ),
					'left'   => esc_html__( 'Left', 'roslyn' ),
					'right'  => esc_html__( 'Right', 'roslyn' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'border_style',
				'title'   => esc_html__( 'Style', 'roslyn' ),
				'options' => array(
					'solid'  => esc_html__( 'Solid', 'roslyn' ),
					'dashed' => esc_html__( 'Dashed', 'roslyn' ),
					'dotted' => esc_html__( 'Dotted', 'roslyn' )
				)
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'roslyn' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'width',
				'title' => esc_html__( 'Width (px or %)', 'roslyn' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'thickness',
				'title' => esc_html__( 'Thickness (px)', 'roslyn' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'top_margin',
				'title' => esc_html__( 'Top Margin (px or %)', 'roslyn' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'bottom_margin',
				'title' => esc_html__( 'Bottom Margin (px or %)', 'roslyn' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		
		echo '<div class="widget eltdf-separator-widget">';
			echo do_shortcode( "[eltdf_separator $params]" ); // XSS OK
		echo '</div>';
	}
}