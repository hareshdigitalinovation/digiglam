<?php
/**
 *
 * General Group Visual Composer options for News Shortcodes
 *
 */

if ( ! function_exists( 'roslyn_news_get_general_shortcode_params' ) ) {
	/**
	 * Function that returns array of general predefined params formatted for Visual Composer
	 *
	 * @return array of params
	 *
	 */
	function roslyn_news_get_general_shortcode_params( $exclude_options = array() ) {
		$params_array = array();
		
		// General Options - start
		
		$params_array[] = array(
			'type'       => 'textfield',
			'param_name' => 'extra_class_name',
			'heading'    => esc_html__( 'Extra Class Name', 'roslyn-news' ),
			'group'      => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'skin',
			'heading'    => esc_html__( 'Skin', 'roslyn-news' ),
			'value'      => array(
				esc_html__( 'Default', 'roslyn-news' ) => '',
				esc_html__( 'Light', 'roslyn-news' )   => 'light'
			),
			'save_always' => true,
			'group'       => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'textfield',
			'param_name'  => 'posts_per_page',
			'heading'     => esc_html__( 'Number of Posts', 'roslyn-news' ),
			'value'       => '6',
			'save_always' => true,
			'group'       => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'column_number',
			'heading'    => esc_html__( 'Number of Columns', 'roslyn-news' ),
			'value'      => array(
				esc_html__( 'Default', 'roslyn-news' ) => '',
				esc_html__( 'One', 'roslyn-news' )     => 1,
				esc_html__( 'Two', 'roslyn-news' )     => 2,
				esc_html__( 'Three', 'roslyn-news' )   => 3,
				esc_html__( 'Four', 'roslyn-news' )    => 4,
				esc_html__( 'Five', 'roslyn-news' )    => 5
			),
			'group'      => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'dropdown',
			'param_name'  => 'block_proportion',
			'heading'     => esc_html__( 'Block Proportion', 'roslyn-news' ),
			'value'       => array(
				'1/2+1/2' => 'two-half',
				'2/3+1/3' => 'two-third-one-third',
				'1/3+2/3' => 'one-third-two-third',
				'3/4+1/4' => 'three-fourths-one-fourth',
			),
			'save_always' => true,
			'group'       => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'dropdown',
			'param_name'  => 'space_between_items',
			'heading'     => esc_html__( 'Space Between Items', 'roslyn-news' ),
			'value'       => array_flip( roslyn_elated_get_space_between_items_array( false, true, true, true ) ),
			'save_always' => true,
			'group'       => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'autocomplete',
			'param_name'  => 'category_name',
			'heading'     => esc_html__( 'Category', 'roslyn-news' ),
			'settings'    => array(
				'multiple'      => true,
				'sortable'      => true,
				'unique_values' => true
			),
			'description' => esc_html__( 'Enter the categories of the posts you want to display (leave empty for showing all categories)', 'roslyn-news' ),
			'group'       => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'autocomplete',
			'param_name'  => 'author_id',
			'heading'     => esc_html__( 'Author', 'roslyn-news' ),
			'settings'    => array(
				'multiple'      => true,
				'sortable'      => true,
				'unique_values' => true
			),
			'description' => esc_html__( 'Enter the authors of the posts you want to display (leave empty for showing all authors)', 'roslyn-news' ),
			'group'       => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'autocomplete',
			'param_name'  => 'tag',
			'heading'     => esc_html__( 'Tag', 'roslyn-news' ),
			'settings'    => array(
				'multiple'      => true,
				'sortable'      => true,
				'unique_values' => true
			),
			'description' => esc_html__( 'Enter the tags of the posts you want to display (leave empty for showing all tags)', 'roslyn-news' ),
			'group'       => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'autocomplete',
			'param_name'  => 'post_in',
			'heading'     => esc_html__( 'Include Posts', 'roslyn-news' ),
			'settings'    => array(
				'multiple'      => true,
				'sortable'      => true,
				'unique_values' => true
			),
			'description' => esc_html__( 'Enter the IDs or Titles of the posts you want to display', 'roslyn-news' ),
			'group'       => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'autocomplete',
			'param_name'  => 'post_not_in',
			'heading'     => esc_html__( 'Exclude Posts', 'roslyn-news' ),
			'settings'    => array(
				'multiple'      => true,
				'sortable'      => true,
				'unique_values' => true
			),
			'description' => esc_html__( 'Enter the IDs or Titles of the posts you want to exclude', 'roslyn-news' ),
			'group'       => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'dropdown',
			'param_name'  => 'sort',
			'heading'     => esc_html__( 'Sort', 'roslyn-news' ),
			'value'       => array(
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
				esc_html__( 'Hot Posts First', 'roslyn-news' )       => 'hot_first'
			),
			'group'       => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'dropdown',
			'param_name'  => 'order',
			'heading'     => esc_html__( 'Order', 'roslyn-news' ),
			'value'       => array_flip( roslyn_elated_get_query_order_array() ),
			'dependency'  => array( 'element' => 'sort', 'value'   => array( 'title' ) ),
			'save_always' => true,
			'group'       => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'textfield',
			'param_name'  => 'offset',
			'heading'     => esc_html__( 'Offset', 'roslyn-news' ),
			'save_always' => true,
			'group'       => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'show_filter',
			'heading'    => esc_html__( 'Show Filter', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'dropdown',
			'param_name'  => 'filter_by',
			'heading'     => esc_html__( 'Filter By', 'roslyn-news' ),
			'value'       => array(
				esc_html__( 'Category', 'roslyn-news' ) => 'category',
				esc_html__( 'Tag', 'roslyn-news' )      => 'tag',
			),
			'save_always' => true,
			'dependency'  => array( 'element' => 'show_filter', 'value' => 'yes' ),
			'group'       => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'       => 'textfield',
			'param_name' => 'layout_title',
			'heading'    => esc_html__( 'Layout Title', 'roslyn-news' ),
			'group'      => esc_html__( 'General', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'layout_title_tag',
			'heading'    => esc_html__( 'Layout Title Tag', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_title_tag( true, array('span' => esc_html__('Custom Heading', 'roslyn-news') ) ) ),
			'group'      => esc_html__( 'General', 'roslyn-news' )
		);
		
		// General Options - end
		
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

/**
 * General Featured Post Item Visual Composer options for News Shortcodes
 */
if ( ! function_exists( 'roslyn_news_get_featured_post_item_shortcode_params' ) ) {
	/**
	 * Function that returns array of featured post item predefined params formatted for Visual Composer
	 *
	 * @return array of params
	 *
	 */
	function roslyn_news_get_featured_post_item_shortcode_params( $exclude_options = array() ) {
		$params_array = array();
		
		// Post Options - Start
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'featured_title_tag',
			'heading'    => esc_html__( 'Title Tag', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_title_tag( true ) ),
			'group'      => esc_html__( 'Featured Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'        => 'dropdown',
			'param_name'  => 'featured_image_size',
			'heading'     => esc_html__( 'Image Size', 'roslyn-news' ),
			'value'       => array(
				esc_html__( 'Default', 'roslyn-news' )   => '',
				esc_html__( 'Thumbnail', 'roslyn-news' ) => 'thumbnail',
				esc_html__( 'Medium', 'roslyn-news' )    => 'medium',
				esc_html__( 'Large', 'roslyn-news' )     => 'large',
				esc_html__( 'Landscape', 'roslyn-news' ) => 'roslyn_elated_landscape',
				esc_html__( 'Portrait', 'roslyn-news' )  => 'roslyn_elated_portrait',
				esc_html__( 'Square', 'roslyn-news' )    => 'roslyn_elated_square',
				esc_html__( 'Full', 'roslyn-news' )      => 'full',
				esc_html__( 'Custom', 'roslyn-news' )    => 'custom'
			),
			'description' => esc_html__( 'Choose image size', 'roslyn-news' ),
			'group'       => esc_html__( 'Featured Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'        => 'textfield',
			'param_name'  => 'featured_custom_image_width',
			'heading'     => esc_html__( 'Custom Image Width', 'roslyn-news' ),
			'description' => esc_html__( 'Enter image width in px', 'roslyn-news' ),
			'dependency'  => array( 'element' => 'featured_image_size', 'value' => 'custom' ),
			'group'       => esc_html__( 'Featured Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'        => 'textfield',
			'param_name'  => 'featured_custom_image_height',
			'heading'     => esc_html__( 'Custom Image Height', 'roslyn-news' ),
			'description' => esc_html__( 'Enter image height in px', 'roslyn-news' ),
			'dependency'  => array( 'element' => 'featured_image_size', 'value' => 'custom' ),
			'group'       => esc_html__( 'Featured Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'featured_display_categories',
			'heading'    => esc_html__( 'Display Categories', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Featured Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'featured_display_excerpt',
			'heading'    => esc_html__( 'Display Excerpt', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Featured Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'        => 'textfield',
			'param_name'  => 'featured_excerpt_length',
			'heading'     => esc_html__( 'Max. Excerpt Length', 'roslyn-news' ),
			'description' => esc_html__( 'Enter max of words that can be shown for excerpt', 'roslyn-news' ),
			'dependency'  => array( 'element' => 'featured_display_excerpt', 'value' => array( '', 'yes' ) ),
			'group'       => esc_html__( 'Featured Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'featured_display_date',
			'heading'    => esc_html__( 'Display Date', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Featured Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'featured_date_format',
			'heading'    => esc_html__( 'Publication Date Format', 'roslyn-news' ),
			'value'      => array(
				esc_html__( 'Default', 'roslyn-news' )               => '',
				esc_html__( 'Time from Publication', 'roslyn-news' ) => 'difference',
				esc_html__( 'Date of Publication', 'roslyn-news' )   => 'published'
			),
			'dependency' => array( 'element' => 'featured_display_date', 'value' => array( '', 'yes' ) ),
			'group'      => esc_html__( 'Featured Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'featured_display_author',
			'heading'    => esc_html__( 'Display Author', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Featured Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'featured_display_comments',
			'heading'    => esc_html__( 'Display Comments', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Featured Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'featured_display_like',
			'heading'    => esc_html__( 'Display Like', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Featured Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'featured_display_views',
			'heading'    => esc_html__( 'Display Views', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Featured Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'featured_display_share',
			'heading'    => esc_html__( 'Display Share', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Featured Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'featured_display_hot_trending_icons',
			'heading'    => esc_html__( 'Display Hot/Trending Icons', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Featured Post Item', 'roslyn-news' ),
		);
		
		// Post Options - end
		
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

/**
 * General Post Item Visual Composer options for News Shortcodes
 */
if ( ! function_exists( 'roslyn_news_get_post_item_shortcode_params' ) ) {
	/**
	 * Function that returns array of post item predefined params formatted for Visual Composer
	 *
	 * @return array of params
	 *
	 */
	function roslyn_news_get_post_item_shortcode_params( $exclude_options = array() ) {
		$params_array = array();
		
		// Post Options - Start
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'title_tag',
			'heading'    => esc_html__( 'Title Tag', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_title_tag( true ) ),
			'group'      => esc_html__( 'Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'        => 'dropdown',
			'param_name'  => 'image_size',
			'heading'     => esc_html__( 'Image Size', 'roslyn-news' ),
			'value'       => array(
				esc_html__( 'Default', 'roslyn-news' )   => '',
				esc_html__( 'Thumbnail', 'roslyn-news' ) => 'thumbnail',
				esc_html__( 'Medium', 'roslyn-news' )    => 'medium',
				esc_html__( 'Large', 'roslyn-news' )     => 'large',
				esc_html__( 'Landscape', 'roslyn-news' ) => 'roslyn_elated_landscape',
				esc_html__( 'Portrait', 'roslyn-news' )  => 'roslyn_elated_portrait',
				esc_html__( 'Square', 'roslyn-news' )    => 'roslyn_elated_square',
				esc_html__( 'Full', 'roslyn-news' )      => 'full',
				esc_html__( 'Custom', 'roslyn-news' )    => 'custom'
			),
			'description' => esc_html__( 'Choose image size', 'roslyn-news' ),
			'group'       => esc_html__( 'Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'        => 'textfield',
			'param_name'  => 'custom_image_width',
			'heading'     => esc_html__( 'Custom Image Width', 'roslyn-news' ),
			'description' => esc_html__( 'Enter image width in px', 'roslyn-news' ),
			'dependency'  => array( 'element' => 'image_size', 'value' => 'custom' ),
			'group'       => esc_html__( 'Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'        => 'textfield',
			'param_name'  => 'custom_image_height',
			'heading'     => esc_html__( 'Custom Image Height', 'roslyn-news' ),
			'description' => esc_html__( 'Enter image height in px', 'roslyn-news' ),
			'dependency'  => array( 'element' => 'image_size', 'value' => 'custom' ),
			'group'       => esc_html__( 'Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'display_categories',
			'heading'    => esc_html__( 'Display Categories', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'display_excerpt',
			'heading'    => esc_html__( 'Display Excerpt', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'        => 'textfield',
			'param_name'  => 'excerpt_length',
			'heading'     => esc_html__( 'Max. Excerpt Length', 'roslyn-news' ),
			'description' => esc_html__( 'Enter max of words that can be shown for excerpt', 'roslyn-news' ),
			'dependency'  => array( 'element' => 'display_excerpt', 'value' => array( '', 'yes' ) ),
			'group'       => esc_html__( 'Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'display_date',
			'heading'    => esc_html__( 'Display Date', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'date_format',
			'heading'    => esc_html__( 'Publication Date Format', 'roslyn-news' ),
			'value'      => array(
				esc_html__( 'Default', 'roslyn-news' )               => '',
				esc_html__( 'Time from Publication', 'roslyn-news' ) => 'difference',
				esc_html__( 'Date of Publication', 'roslyn-news' )   => 'published'
			),
			'dependency' => array( 'element' => 'display_date', 'value' => array( '', 'yes' ) ),
			'group'      => esc_html__( 'Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'display_author',
			'heading'    => esc_html__( 'Display Author', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Post Item', 'roslyn-news' ),
			'save_always' => true
		);

		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'display_author_style',
			'heading'    => esc_html__( 'Style Author', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Post Item', 'roslyn-news' ),
			'dependency'  => array( 'element' => 'display_author', 'value' => array( 'yes' ) )
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'display_comments',
			'heading'    => esc_html__( 'Display Comments', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'display_like',
			'heading'    => esc_html__( 'Display Like', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Post Item', 'roslyn-news' ),
		);

		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'display_hot_trending_icons',
			'heading'    => esc_html__( 'Display Hot/Trending Icons', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Post Item', 'roslyn-news' ),
		);

		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'display_button',
			'heading'    => esc_html__( 'Display Read More Button', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'display_views',
			'heading'    => esc_html__( 'Display Views', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Post Item', 'roslyn-news' ),
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'display_share',
			'heading'    => esc_html__( 'Display Share', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Post Item', 'roslyn-news' ),
		);
		
		// Post Options - end
		
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

/**
 * Pagination Group Visual Composer Options for Shortcodes
 */
if ( ! function_exists( 'roslyn_news_get_pagination_shortcode_params' ) ) {
	/**
	 * Function that returns array of pagination predefined params formatted for Visual Composer
	 *
	 * @return array of params
	 *
	 */
	function roslyn_news_get_pagination_shortcode_params( $exclude_options = array() ) {
		$params_array = array();
		
		// Pagination options - start
		
		$params_array[] = array(
			'type'        => 'dropdown',
			'param_name'  => 'display_pagination',
			'heading'     => esc_html__( 'Display Pagination', 'roslyn-news' ),
			'value'       => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'save_always' => true,
			'group'       => esc_html__( 'Pagination', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'dropdown',
			'param_name'  => 'pagination_type',
			'heading'     => esc_html__( 'Pagination Type', 'roslyn-news' ),
			'value'       => array(
				esc_html__( 'Standard', 'roslyn-news' )        => 'standard',
				esc_html__( 'Load More', 'roslyn-news' )       => 'load-more',
				esc_html__( 'Infinite Scroll', 'roslyn-news' ) => 'infinite-scroll'
			),
			'save_always' => true,
			'dependency'  => array( 'element' => 'display_pagination', 'value' => array( 'yes' ) ),
			'group'       => esc_html__( 'Pagination', 'roslyn-news' )
		);

		$params_array[] = array(
			'type'        => 'dropdown',
			'param_name'  => 'pagination_skin',
			'heading'     => esc_html__( 'Pagination Skin', 'roslyn-news' ),
			'value'       => array(
				esc_html__( 'Default', 'roslyn-news' )   => '',
				esc_html__( 'Light', 'roslyn-news' )  => 'light-pagination',
			),
			'save_always' => true,
			'dependency'  => array( 'element' => 'pagination_type', 'value' => 'load-more' ),
			'group'       => esc_html__( 'Pagination', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'textfield',
			'param_name'  => 'pagination_numbers_amount',
			'heading'     => esc_html__( 'Amount of Navigation Numbers', 'roslyn-news' ),
			'description' => esc_html__( 'Enter a number that will limit pagination numbers amount', 'roslyn-news' ),
			'dependency'  => array( 'element' => 'pagination_type', 'value' => array( '', 'standard' ) ),
			'group'       => esc_html__( 'Pagination', 'roslyn-news' ),
		);
		
		// Pagination Options - End
		
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

/**
 * Slider Settings Group Visual Composer Options for Shortcodes (Carousels and Sliders)
 */
if ( ! function_exists( 'roslyn_news_get_slider_shortcode_params' ) ) {
	/**
	 * Function that returns array of slider settings predefined params formatted for Visual Composer
	 *
	 * @return array of params
	 *
	 */
	function roslyn_news_get_slider_shortcode_params( $exclude_options = array() ) {
		$params_array = array();
		
		// Slider Settings Options - start
		
		$params_array[] = array(
			'type'        => 'dropdown',
			'param_name'  => 'number_of_visible_items',
			'heading'     => esc_html__( 'Number Of Visible Items', 'roslyn-news' ),
			'value'       => array(
				esc_html__( 'One', 'roslyn-news' )   => '1',
				esc_html__( 'Two', 'roslyn-news' )   => '2',
				esc_html__( 'Three', 'roslyn-news' ) => '3',
				esc_html__( 'Four', 'roslyn-news' )  => '4',
				esc_html__( 'Five', 'roslyn-news' )  => '5',
				esc_html__( 'Six', 'roslyn-news' )   => '6'
			),
			'save_always' => true,
			'group'       => esc_html__( 'Slider Settings', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'dropdown',
			'param_name'  => 'enable_loop',
			'heading'     => esc_html__( 'Enable Slider Loop', 'roslyn-news' ),
			'value'       => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'save_always' => true,
			'group'       => esc_html__( 'Slider Settings', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'dropdown',
			'param_name'  => 'enable_autoplay',
			'heading'     => esc_html__( 'Enable Slider Autoplay', 'roslyn-news' ),
			'value'       => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'save_always' => true,
			'group'       => esc_html__( 'Slider Settings', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'textfield',
			'param_name'  => 'slider_speed',
			'heading'     => esc_html__( 'Slide Duration', 'roslyn-news' ),
			'description' => esc_html__( 'Default value is 5000 (ms)', 'roslyn-news' ),
			'group'       => esc_html__( 'Slider Settings', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'        => 'textfield',
			'param_name'  => 'slider_speed_animation',
			'heading'     => esc_html__( 'Slide Animation Duration', 'roslyn-news' ),
			'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'roslyn-news' ),
			'group'       => esc_html__( 'Slider Settings', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'display_navigation',
			'heading'    => esc_html__( 'Display Navigation', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Slider Settings', 'roslyn-news' )
		);
		
		$params_array[] = array(
			'type'       => 'dropdown',
			'param_name' => 'display_pagination',
			'heading'    => esc_html__( 'Display Pagination', 'roslyn-news' ),
			'value'      => array_flip( roslyn_elated_get_yes_no_select_array() ),
			'group'      => esc_html__( 'Slider Settings', 'roslyn-news' )
		);
		
		// Slider Settings Options - end
		
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

if ( ! function_exists( 'roslyn_news_get_widget_params_from_VC' ) ) {
	function roslyn_news_get_widget_params_from_VC( $params_array ) {
		$widget_params_array = array();
		$i                   = 0;
		
		foreach ( $params_array as $one_parameter_array ) {
			$widget_params_array[ $i ] = array();
			
			if ( $one_parameter_array['type'] == 'autocomplete' ) {
				$widget_params_array[ $i ]['type'] = 'textfield';
			} else {
				$widget_params_array[ $i ]['type'] = $one_parameter_array['type'];
			}
			
			$widget_params_array[ $i ]['title'] = $one_parameter_array['heading'];
			$widget_params_array[ $i ]['name']  = $one_parameter_array['param_name'];
			
			if ( isset( $one_parameter_array['description'] ) ) {
				$widget_params_array[ $i ]['description'] = $one_parameter_array['description'];
			}
			
			if ( isset( $one_parameter_array['value'] ) && is_array( $one_parameter_array['value'] ) && count( $one_parameter_array['value'] ) ) {
				$widget_params_array[ $i ]['options'] = array_flip( $one_parameter_array['value'] );
			}
			
			$i ++;
		}
		
		return $widget_params_array;
	}
}