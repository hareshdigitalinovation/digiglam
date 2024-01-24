<?php

foreach ( glob( ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'roslyn_elated_map_blog_meta' ) ) {
	function roslyn_elated_map_blog_meta() {
		$eltdf_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$eltdf_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'roslyn' ),
				'name'  => 'blog_meta'
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'roslyn' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'roslyn' ),
				'parent'      => $blog_meta_box,
				'options'     => $eltdf_blog_categories
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'roslyn' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'roslyn' ),
				'parent'      => $blog_meta_box,
				'options'     => $eltdf_blog_categories,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_masonry_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Layout', 'roslyn' ),
				'description' => esc_html__( 'Set masonry layout. Default is in grid.', 'roslyn' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''           => esc_html__( 'Default', 'roslyn' ),
					'in-grid'    => esc_html__( 'In Grid', 'roslyn' ),
					'full-width' => esc_html__( 'Full Width', 'roslyn' )
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_masonry_number_of_columns_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Number of Columns', 'roslyn' ),
				'description' => esc_html__( 'Set number of columns for your masonry blog lists', 'roslyn' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''      => esc_html__( 'Default', 'roslyn' ),
					'two'   => esc_html__( '2 Columns', 'roslyn' ),
					'three' => esc_html__( '3 Columns', 'roslyn' ),
					'four'  => esc_html__( '4 Columns', 'roslyn' ),
					'five'  => esc_html__( '5 Columns', 'roslyn' )
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_masonry_space_between_items_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Space Between Items', 'roslyn' ),
				'description' => esc_html__( 'Set space size between posts for your masonry blog lists', 'roslyn' ),
				'options'     => roslyn_elated_get_space_between_items_array( true ),
				'parent'      => $blog_meta_box
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_blog_list_featured_image_proportion_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'roslyn' ),
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'roslyn' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'roslyn' ),
					'fixed'    => esc_html__( 'Fixed', 'roslyn' ),
					'original' => esc_html__( 'Original', 'roslyn' )
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'roslyn' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'roslyn' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'roslyn' ),
					'standard'        => esc_html__( 'Standard', 'roslyn' ),
					'load-more'       => esc_html__( 'Load More', 'roslyn' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'roslyn' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'roslyn' )
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'eltdf_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'roslyn' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'roslyn' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_elated_map_blog_meta', 30 );
}