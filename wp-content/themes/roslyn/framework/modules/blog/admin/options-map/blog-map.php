<?php

if ( ! function_exists( 'roslyn_elated_get_blog_list_types_options' ) ) {
	function roslyn_elated_get_blog_list_types_options() {
		$blog_list_type_options = apply_filters( 'roslyn_elated_blog_list_type_global_option', $blog_list_type_options = array() );
		
		return $blog_list_type_options;
	}
}

if ( ! function_exists( 'roslyn_elated_blog_options_map' ) ) {
	function roslyn_elated_blog_options_map() {
		$blog_list_type_options = roslyn_elated_get_blog_list_types_options();
		
		roslyn_elated_add_admin_page(
			array(
				'slug'  => '_blog_page',
				'title' => esc_html__( 'Blog', 'roslyn' ),
				'icon'  => 'fa fa-files-o'
			)
		);
		
		/**
		 * Blog Lists
		 */
		$panel_blog_lists = roslyn_elated_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_lists',
				'title' => esc_html__( 'Blog Lists', 'roslyn' )
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'        => 'blog_list_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'roslyn' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for blog post lists. Default value is large', 'roslyn' ),
				'options'     => roslyn_elated_get_space_between_items_array( true ),
				'parent'      => $panel_blog_lists
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'blog_list_type',
				'type'          => 'select',
				'label'         => esc_html__( 'Blog Layout for Archive Pages', 'roslyn' ),
				'description'   => esc_html__( 'Choose a default blog layout for archived blog post lists', 'roslyn' ),
				'default_value' => 'standard',
				'parent'        => $panel_blog_lists,
				'options'       => $blog_list_type_options
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'archive_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout for Archive Pages', 'roslyn' ),
				'description'   => esc_html__( 'Choose a sidebar layout for archived blog post lists', 'roslyn' ),
				'default_value' => '',
				'parent'        => $panel_blog_lists,
                'options'       => roslyn_elated_get_custom_sidebars_options(),
			)
		);
		
		$roslyn_custom_sidebars = roslyn_elated_get_custom_sidebars();
		if ( is_array( $roslyn_custom_sidebars ) && count( $roslyn_custom_sidebars ) > 0 ) {
			roslyn_elated_add_admin_field(
				array(
					'name'        => 'archive_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display for Archive Pages', 'roslyn' ),
					'description' => esc_html__( 'Choose a sidebar to display on archived blog post lists. Default sidebar is "Sidebar Page"', 'roslyn' ),
					'parent'      => $panel_blog_lists,
					'options'     => roslyn_elated_get_custom_sidebars(),
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'blog_masonry_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Layout', 'roslyn' ),
				'default_value' => 'in-grid',
				'description'   => esc_html__( 'Set masonry layout. Default is in grid.', 'roslyn' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'in-grid'    => esc_html__( 'In Grid', 'roslyn' ),
					'full-width' => esc_html__( 'Full Width', 'roslyn' )
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'blog_masonry_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Number of Columns', 'roslyn' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for your masonry blog lists. Default value is 4 columns', 'roslyn' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'two'   => esc_html__( '2 Columns', 'roslyn' ),
					'three' => esc_html__( '3 Columns', 'roslyn' ),
					'four'  => esc_html__( '4 Columns', 'roslyn' ),
					'five'  => esc_html__( '5 Columns', 'roslyn' )
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'blog_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Space Between Items', 'roslyn' ),
				'description'   => esc_html__( 'Set space size between posts for your masonry blog lists. Default value is normal', 'roslyn' ),
				'default_value' => 'normal',
				'options'       => roslyn_elated_get_space_between_items_array(),
				'parent'        => $panel_blog_lists
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'blog_list_featured_image_proportion',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'roslyn' ),
				'default_value' => 'fixed',
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'roslyn' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'fixed'    => esc_html__( 'Fixed', 'roslyn' ),
					'original' => esc_html__( 'Original', 'roslyn' )
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'blog_pagination_type',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'roslyn' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'roslyn' ),
				'parent'        => $panel_blog_lists,
				'default_value' => 'standard',
				'options'       => array(
					'standard'        => esc_html__( 'Standard', 'roslyn' ),
					'load-more'       => esc_html__( 'Load More', 'roslyn' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'roslyn' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'roslyn' )
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'number_of_chars',
				'default_value' => '40',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'roslyn' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'roslyn' ),
				'parent'        => $panel_blog_lists,
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		roslyn_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_tags_area_blog',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Blog Tags on Standard List', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will show tags on standard blog list', 'roslyn' ),
				'parent'        => $panel_blog_lists
			)
		);

		roslyn_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'predefined_style',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Predefined Blog Style', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will show post content overlapping the post image', 'roslyn' ),
				'parent'        => $panel_blog_lists
			)
		);
		
		/**
		 * Blog Single
		 */
		$panel_blog_single = roslyn_elated_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_single',
				'title' => esc_html__( 'Blog Single', 'roslyn' )
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'        => 'blog_single_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'roslyn' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for Blog Single pages. Default value is large', 'roslyn' ),
				'options'     => roslyn_elated_get_space_between_items_array( true ),
				'parent'      => $panel_blog_single
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'blog_single_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'roslyn' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog Single pages', 'roslyn' ),
				'default_value' => '',
				'parent'        => $panel_blog_single,
                'options'       => roslyn_elated_get_custom_sidebars_options()
			)
		);
		
		if ( is_array( $roslyn_custom_sidebars ) && count( $roslyn_custom_sidebars ) > 0 ) {
			roslyn_elated_add_admin_field(
				array(
					'name'        => 'blog_single_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display', 'roslyn' ),
					'description' => esc_html__( 'Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'roslyn' ),
					'parent'      => $panel_blog_single,
					'options'     => roslyn_elated_get_custom_sidebars(),
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_blog',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'roslyn' ),
				'parent'        => $panel_blog_single,
				'options'       => roslyn_elated_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'blog_single_title_in_title_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Post Title in Title Area', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will show post title in title area on single post pages', 'roslyn' ),
				'parent'        => $panel_blog_single,
				'dependency' => array(
					'hide' => array(
						'show_title_area_blog' => 'no'
					)
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'blog_single_related_posts',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Related Posts', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will show related posts on single post pages', 'roslyn' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'yes'
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'blog_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments Form', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will show comments form on single post pages', 'roslyn' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'yes'
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_navigation',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Prev/Next Single Post Navigation Links', 'roslyn' ),
				'description'   => esc_html__( 'Enable navigation links through the blog posts (left and right arrows will appear)', 'roslyn' ),
				'parent'        => $panel_blog_single
			)
		);
		
		$blog_single_navigation_container = roslyn_elated_add_admin_container(
			array(
				'name'            => 'eltdf_blog_single_navigation_container',
				'parent'          => $panel_blog_single,
				'dependency' => array(
					'show' => array(
						'blog_single_navigation' => 'yes'
					)
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Navigation Only in Current Category', 'roslyn' ),
				'description'   => esc_html__( 'Limit your navigation only through current category', 'roslyn' ),
				'parent'        => $blog_single_navigation_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Author Info Box', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will display author name and descriptions on single post pages. Author biographic info field in Users section must contain some data', 'roslyn' ),
				'parent'        => $panel_blog_single
			)
		);
		
		$blog_single_author_info_container = roslyn_elated_add_admin_container(
			array(
				'name'            => 'eltdf_blog_single_author_info_container',
				'parent'          => $panel_blog_single,
				'dependency' => array(
					'show' => array(
						'blog_author_info' => 'yes'
					)
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info_email',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Author Email', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will show author email', 'roslyn' ),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_author_social',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Author Social Icons', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will show author social icons on single post pages', 'roslyn' ),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		do_action( 'roslyn_elated_blog_single_options_map', $panel_blog_single );
	}
	
	add_action( 'roslyn_elated_options_map', 'roslyn_elated_blog_options_map', 13 );
}