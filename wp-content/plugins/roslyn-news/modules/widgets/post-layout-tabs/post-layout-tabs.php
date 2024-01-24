<?php

class RoslynfNewsClassPostLayoutTabs extends RoslynNewsPhpClassWidget {
	
	public function __construct() {
		parent::__construct(
			'eltdf_post_layout_tabs_widget', // Base ID
			'Roslyn Post Layout Tabs Widget' // Name
		);

		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'        => 'dropdown',
				'name'        => 'layout',
				'title'       => esc_html__( 'Posts Layout', 'roslyn-news' ),
				'options'     => array(
					'layout1'             => esc_html__( 'Layout 1', 'roslyn-news' ),
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'column_number',
				'title'   => esc_html__( 'Number of Columns', 'roslyn-news' ),
				'options' => array(
					4 => esc_html__( 'Four Columns', 'roslyn-news' ),
					1 => esc_html__( 'One Column', 'roslyn-news' ),
					2 => esc_html__( 'Two Columns', 'roslyn-news' ),
					3 => esc_html__( 'Three Columns', 'roslyn-news' ),
					5 => esc_html__( 'Five Columns', 'roslyn-news' ),
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'space_between_items',
				'title'   => esc_html__( 'Space Between Items', 'roslyn-news' ),
				'options' => roslyn_elated_get_space_between_items_array( true, true, true, true )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'category_id_1',
				'title'   => esc_html__( 'First Category', 'roslyn-news' ),
				'options' => roslyn_news_get_post_categories()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'category_id_2',
				'title'   => esc_html__( 'Second Category', 'roslyn-news' ),
				'options' => roslyn_news_get_post_categories()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'category_id_3',
				'title'   => esc_html__( 'Third Category', 'roslyn-news' ),
				'options' => roslyn_news_get_post_categories(),
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'category_id_4',
				'title'   => esc_html__( 'Fourth Category', 'roslyn-news' ),
				'options' => roslyn_news_get_post_categories()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'category_id_5',
				'title'   => esc_html__( 'Fifth Category', 'roslyn-news' ),
				'options' => roslyn_news_get_post_categories()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'category_id_6',
				'title'   => esc_html__( 'Sixth Category', 'roslyn-news' ),
				'options' => roslyn_news_get_post_categories()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'sort',
				'title'   => esc_html__( 'Sort', 'roslyn-news' ),
				'options' => array_flip( array(
					esc_html__( 'Default', 'roslyn-news' )               => '',
					esc_html__( 'Latest', 'roslyn-news' )                => 'latest',
					esc_html__( 'Random', 'roslyn-news' )                => 'random',
					esc_html__( 'Random Posts Today', 'roslyn-news' )    => 'random_today',
					esc_html__( 'Random in Last 7 Days', 'roslyn-news' ) => 'random_seven_days',
					esc_html__( 'Most Commented', 'roslyn-news' )        => 'comments',
					esc_html__( 'Title', 'roslyn-news' )                 => 'title',
					esc_html__( 'Popular', 'roslyn-news' )               => 'popular',
					esc_html__( 'Featured Posts First', 'roslyn-news' )  => 'featured_first',
					esc_html__( 'Trending Posts First', 'roslyn-news' )  => 'trending_first',
					esc_html__( 'Hot Posts First', 'roslyn-news' )       => 'hot_first',
					esc_html__( 'By Reaction', 'roslyn-news' )           => 'reactions'
				) )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'custom_image_width',
				'title'       => esc_html__( 'Image Width (px)', 'roslyn-news' ),
				'description' => esc_html__( 'Set custom image width (px)', 'roslyn-news' ),
			),
			array(
				'type'        => 'textfield',
				'name'        => 'custom_image_height',
				'title'       => esc_html__( 'Image Height (px)', 'roslyn-news' ),
				'description' => esc_html__( 'Set custom image height (px)', 'roslyn-news' ),
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'title_tag',
				'title'   => esc_html__( 'Title Tag', 'roslyn-news' ),
				'options' => roslyn_elated_get_title_tag( true )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'title_length',
				'title'       => esc_html__( 'Title Max Characters', 'roslyn-news' ),
				'description' => esc_html__( 'Enter max character of title post list that you want to display', 'roslyn-news' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'display_date',
				'title'   => esc_html__( 'Display Date', 'roslyn-news' ),
				'options' => roslyn_elated_get_yes_no_select_array( false, true )
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'date_format',
				'title'       => esc_html__( 'Date Format', 'roslyn-news' ),
				'options'     => array(
					''           => esc_html__( 'Default', 'roslyn-news' ),
					'difference' => esc_html__( 'Time from Publication', 'roslyn-news' ),
					'published'  => esc_html__( 'Date of Publication', 'roslyn-news' )
				),
				'description' => esc_html__( 'Enter the date format that you want to display', 'roslyn-news' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'display_comments',
				'title'   => esc_html__( 'Display Comments', 'roslyn-news' ),
				'options' => roslyn_elated_get_yes_no_select_array( false )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'display_post_type_icon',
				'title'   => esc_html__( 'Display Post Type Icon', 'roslyn-news' ),
				'options' => roslyn_elated_get_yes_no_select_array( false )
			)
		);
	}

	/**
	 * Generates widget's HTML
	 *
	 * @param array $args args from widget area
	 * @param array $instance widget's options
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		
		//prepare variables
		if ( is_array( $instance ) && count( $instance ) ) {
			$params_label                    = 'params';
			$categories                      = array();
			$instance['posts_per_page']      = $instance['column_number'];
			$instance['image_size']          = 'custom';
			$instance['custom_image_width']  = $instance['custom_image_width'] != '' ? $instance['custom_image_width'] : '320';
			$instance['custom_image_height'] = $instance['custom_image_height'] != '' ? $instance['custom_image_height'] : '200';
			$instance['date_format']         = $instance['date_format'] != '' ? $instance['date_format'] : 'difference';
			$instance['space_between_items'] = $instance['space_between_items'] != '' ? $instance['space_between_items'] : 'normal';
			$instance['display_like']        = 'no';
			$instance['display_comments']    = 'no';
			$instance['layout']              = ! empty( $instance['layout'] ) ? $instance['layout'] : 'layout2';
			
			if ( $instance['layout'] === 'layout2' ) {
				$instance['display_excerpt'] = 'no';
			}
			
			for ( $i = 1; $i <= 6; $i ++ ) {
				${$params_label . $i} = '';
				$categories[ $i ]     = $instance[ 'category_id_' . $i ];
				unset( $instance[ 'category_id_' . $i ] );
			}

			//generate shortcode params
			for ( $i = 1; $i <= 6; $i ++ ) {
				foreach ( $instance as $key => $value ) {
					${$params_label . $i} .= " " . $key . " = '" . $value . "' ";
				}
				if( $categories[ $i ] !== 'all' ) {
					${$params_label . $i} .= " category_name = '" . $categories[ $i ] . "' ";
				}
			}

			$html = '<div class="widget eltdf-plw-tabs">';
			$html .= '<div class="eltdf-plw-tabs-inner">';
			$html .= '<div class="eltdf-plw-tabs-tabs-holder">';

			foreach ( $categories as $key => $value ) {
				$term          = get_category_by_slug( $value );
				$category_name = $value !== 'all' ? esc_attr( $term->name ) : esc_html__( 'All', 'roslyn-news' );
				$html          .= '<h6 class="eltdf-plw-tabs-tab"><a href="'.get_category_link($term->term_id).'"><span class="item_text">' . $category_name . '</span></a></h6>';
			}

			$html .= '</div>'; //close div.eltdf-plw-tabs-tabs-holder

			$html .= '<div class="eltdf-plw-tabs-content-holder">';

			for ( $i = 1; $i <= count($categories); $i++ ) {
				$html .= '<div class="eltdf-plw-tabs-content">';
				$html .= do_shortcode( '[eltdf_' . $instance['layout'] . ' ' . ${$params_label . $i} . ']' ); // XSS OK
				$html .= '</div>';
			}

			$html .= '</div>'; //close div.eltdf-plw-tabs-content-holder
			$html .= '</div>'; //close div.eltdf-plw-tabs-inner
			$html .= '</div>'; //close div.eltdf-plw-tabs

			echo wp_kses_post( $html );
		}
	}
}