<?php

if ( ! function_exists( 'roslyn_elated_woocommerce_options_map' ) ) {
	
	/**
	 * Add Woocommerce options page
	 */
	function roslyn_elated_woocommerce_options_map() {
		
		roslyn_elated_add_admin_page(
			array(
				'slug'  => '_woocommerce_page',
				'title' => esc_html__( 'Woocommerce', 'roslyn' ),
				'icon'  => 'fa fa-shopping-cart'
			)
		);
		
		/**
		 * Product List Settings
		 */
		$panel_product_list = roslyn_elated_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_product_list',
				'title' => esc_html__( 'Product List', 'roslyn' )
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'eltdf_woo_product_list_columns',
				'label'         => esc_html__( 'Product List Columns', 'roslyn' ),
				'default_value' => 'eltdf-woocommerce-columns-4',
				'description'   => esc_html__( 'Choose number of columns for main shop page', 'roslyn' ),
				'options'       => array(
					'eltdf-woocommerce-columns-3' => esc_html__( '3 Columns', 'roslyn' ),
					'eltdf-woocommerce-columns-4' => esc_html__( '4 Columns', 'roslyn' )
				),
				'parent'        => $panel_product_list,
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'eltdf_woo_product_list_columns_space',
				'label'         => esc_html__( 'Space Between Items', 'roslyn' ),
				'description'   => esc_html__( 'Select space between items for product listing and related products on single product', 'roslyn' ),
				'default_value' => 'normal',
				'options'       => roslyn_elated_get_space_between_items_array(),
				'parent'        => $panel_product_list,
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'eltdf_woo_product_list_info_position',
				'label'         => esc_html__( 'Product Info Position', 'roslyn' ),
				'default_value' => 'info_below_image',
				'description'   => esc_html__( 'Select product info position for product listing and related products on single product', 'roslyn' ),
				'options'       => array(
					'info_below_image'    => esc_html__( 'Info Below Image', 'roslyn' ),
					'info_on_image_hover' => esc_html__( 'Info On Image Hover', 'roslyn' )
				),
				'parent'        => $panel_product_list,
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'eltdf_woo_products_per_page',
				'label'         => esc_html__( 'Number of products per page', 'roslyn' ),
				'description'   => esc_html__( 'Set number of products on shop page', 'roslyn' ),
				'parent'        => $panel_product_list,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'eltdf_products_list_title_tag',
				'label'         => esc_html__( 'Products Title Tag', 'roslyn' ),
				'default_value' => 'h4',
				'options'       => roslyn_elated_get_title_tag(),
				'parent'        => $panel_product_list,
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'woo_enable_percent_sign_value',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Percent Sign', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will show percent value mark instead of sale label on products', 'roslyn' ),
				'parent'        => $panel_product_list
			)
		);
		
		/**
		 * Single Product Settings
		 */
		$panel_single_product = roslyn_elated_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_single_product',
				'title' => esc_html__( 'Single Product', 'roslyn' )
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_woo',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'roslyn' ),
				'parent'        => $panel_single_product,
				'options'       => roslyn_elated_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'eltdf_single_product_title_tag',
				'default_value' => 'h2',
				'label'         => esc_html__( 'Single Product Title Tag', 'roslyn' ),
				'options'       => roslyn_elated_get_title_tag(),
				'parent'        => $panel_single_product,
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_number_of_thumb_images',
				'default_value' => '3',
				'label'         => esc_html__( 'Number of Thumbnail Images per Row', 'roslyn' ),
				'options'       => array(
					'4' => esc_html__( 'Four', 'roslyn' ),
					'3' => esc_html__( 'Three', 'roslyn' ),
					'2' => esc_html__( 'Two', 'roslyn' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_set_thumb_images_position',
				'default_value' => 'on-left-side',
				'label'         => esc_html__( 'Set Thumbnail Images Position', 'roslyn' ),
				'options'       => array(
                    'on-left-side' => esc_html__( 'On The Left Side Of Featured Image', 'roslyn' ),
					'below-image'  => esc_html__( 'Below Featured Image', 'roslyn' ),
				),
				'parent'        => $panel_single_product
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_enable_single_product_zoom_image',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Zoom Maginfier', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will show magnifier image on featured image hover', 'roslyn' ),
				'parent'        => $panel_single_product,
				'options'       => roslyn_elated_get_yes_no_select_array( false ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_set_single_images_behavior',
				'default_value' => 'pretty-photo',
				'label'         => esc_html__( 'Set Images Behavior', 'roslyn' ),
				'options'       => array(
					'pretty-photo' => esc_html__( 'Pretty Photo Lightbox', 'roslyn' ),
					'photo-swipe'  => esc_html__( 'Photo Swipe Lightbox', 'roslyn' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'eltdf_woo_related_products_columns',
				'label'         => esc_html__( 'Related Products Columns', 'roslyn' ),
				'default_value' => 'eltdf-woocommerce-columns-4',
				'description'   => esc_html__( 'Choose number of columns for related products on single product page', 'roslyn' ),
				'options'       => array(
					'eltdf-woocommerce-columns-3' => esc_html__( '3 Columns', 'roslyn' ),
					'eltdf-woocommerce-columns-4' => esc_html__( '4 Columns', 'roslyn' )
				),
				'parent'        => $panel_single_product,
			)
		);

		do_action('roslyn_elated_woocommerce_additional_options_map');
	}
	
	add_action( 'roslyn_elated_options_map', 'roslyn_elated_woocommerce_options_map', 21 );
}