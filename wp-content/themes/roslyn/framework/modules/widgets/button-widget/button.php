<?php

class RoslynElatedButtonWidget extends RoslynElatedWidget {
	public function __construct() {
		parent::__construct(
			'eltdf_button_widget',
			esc_html__( 'Roslyn Button Widget', 'roslyn' ),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'roslyn' ) )
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
					'solid'   => esc_html__( 'Solid', 'roslyn' ),
					'outline' => esc_html__( 'Outline', 'roslyn' ),
					'simple'  => esc_html__( 'Simple', 'roslyn' )
				)
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'size',
				'title'       => esc_html__( 'Size', 'roslyn' ),
				'options'     => array(
					'small'  => esc_html__( 'Small', 'roslyn' ),
					'medium' => esc_html__( 'Medium', 'roslyn' ),
					'large'  => esc_html__( 'Large', 'roslyn' ),
					'huge'   => esc_html__( 'Huge', 'roslyn' )
				),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'roslyn' )
			),
			array(
				'type'    => 'textfield',
				'name'    => 'text',
				'title'   => esc_html__( 'Text', 'roslyn' ),
				'default' => esc_html__( 'Button Text', 'roslyn' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__( 'Link', 'roslyn' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__( 'Link Target', 'roslyn' ),
				'options' => roslyn_elated_get_link_target_array()
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'roslyn' )
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'hover_color',
				'title' => esc_html__( 'Hover Color', 'roslyn' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'background_color',
				'title'       => esc_html__( 'Background Color', 'roslyn' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'roslyn' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'hover_background_color',
				'title'       => esc_html__( 'Hover Background Color', 'roslyn' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'roslyn' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'border_color',
				'title'       => esc_html__( 'Border Color', 'roslyn' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'roslyn' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'hover_border_color',
				'title'       => esc_html__( 'Hover Border Color', 'roslyn' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'roslyn' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'margin',
				'title'       => esc_html__( 'Margin', 'roslyn' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'roslyn' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$params = '';
		
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		// Filter out all empty params
		$instance = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );
		
		// Default values
		if ( ! isset( $instance['text'] ) ) {
			$instance['text'] = 'Button Text';
		}
		
		// Generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}
		
		echo '<div class="widget eltdf-button-widget">';
			echo do_shortcode( "[eltdf_button $params]" ); // XSS OK
		echo '</div>';
	}
}