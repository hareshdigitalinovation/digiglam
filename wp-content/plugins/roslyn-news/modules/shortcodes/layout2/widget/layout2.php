<?php

class RoslynNewsClassWidgetLayout2 extends RoslynNewsPhpClassWidget {
	public function __construct() {
		parent::__construct(
			'eltdf_layout2_widget',
			esc_html__( 'Roslyn Layout 2 Widget', 'roslyn-news' ),
			array( 'description' => esc_html__( 'Display a layout 2', 'roslyn-news' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		// General Options - start
		$params_general_array = roslyn_news_get_widget_params_from_VC( roslyn_news_get_general_shortcode_params( array(
			'block_proportion',
			'layout_title',
			'column_number',
			'layout_title_tag'
		) ) );
		// General Options - end
		
		// Post Item Options - start
		$params_post_item_array = roslyn_news_get_widget_params_from_VC( roslyn_news_get_post_item_shortcode_params( array(
			'excerpt_length',
			'display_views'
		) ) );
		// Post Item Options - end
		
		$this->params = array_merge(
			array(
				array(
					'type' => 'textfield',
					'name' => 'widget_title',
					'title' => esc_html__( 'Widget Title', 'roslyn-news' )
				),
				array(
					'type'       => 'dropdown',
					'name'       => 'alignment',
					'title'      => esc_html__( 'Content Alignment', 'roslyn-news' ),
					'options' => array(
						'left'      => esc_html__( 'Left', 'roslyn-news' ),
						'center'    => esc_html__( 'Center', 'roslyn-news' ),
					)
				)
			),
			$params_general_array,
			$params_post_item_array
		);
	}
	
	/**
	 * Generates widget's HTML
	 *
	 * @param array $args args from widget area
	 * @param array $instance widget's options
	 */
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		$instance['column_number'] = '1';
		
		// Filter out all empty params
		$instance = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );
		
		echo '<div class="widget eltdf-news-widget eltdf-news-layout2-widget">';
			if ( ! empty( $instance['widget_title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
			}
			
			echo roslyn_elated_execute_shortcode( 'eltdf_layout2', $instance ); // XSS OK
		echo '</div>';
	}
}