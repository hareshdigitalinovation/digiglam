<?php

/*** Post Settings ***/

if ( ! function_exists( 'roslyn_elated_map_post_meta' ) ) {
	function roslyn_elated_map_post_meta() {
		
		$post_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'roslyn' ),
				'name'  => 'post-meta'
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'roslyn' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'roslyn' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => roslyn_elated_get_custom_sidebars_options( true )
			)
		);
		
		$roslyn_custom_sidebars = roslyn_elated_get_custom_sidebars();
		if ( is_array( $roslyn_custom_sidebars ) && count( $roslyn_custom_sidebars ) > 0 ) {
			roslyn_elated_create_meta_box_field( array(
				'name'        => 'eltdf_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'roslyn' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'roslyn' ),
				'parent'      => $post_meta_box,
				'options'     => roslyn_elated_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'roslyn' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'roslyn' ),
				'parent'      => $post_meta_box
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_blog_masonry_gallery_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Fixed Proportion', 'roslyn' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry lists in fixed proportion', 'roslyn' ),
				'default_value' => 'small',
				'parent'        => $post_meta_box,
				'options'       => array(
					'small'              => esc_html__( 'Small', 'roslyn' ),
					'large-width'        => esc_html__( 'Large Width', 'roslyn' ),
					'large-height'       => esc_html__( 'Large Height', 'roslyn' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'roslyn' )
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_blog_masonry_gallery_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Original Proportion', 'roslyn' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry lists in original proportion', 'roslyn' ),
				'default_value' => 'default',
				'parent'        => $post_meta_box,
				'options'       => array(
					'default'     => esc_html__( 'Default', 'roslyn' ),
					'large-width' => esc_html__( 'Large Width', 'roslyn' )
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'roslyn' ),
				'parent'        => $post_meta_box,
				'options'       => roslyn_elated_get_yes_no_select_array()
			)
		);

		do_action('roslyn_elated_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_elated_map_post_meta', 20 );
}
