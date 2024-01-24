<?php

if ( ! function_exists( 'roslyn_elated_map_woocommerce_meta' ) ) {
	function roslyn_elated_map_woocommerce_meta() {
		
		$woocommerce_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'roslyn' ),
				'name'  => 'woo_product_meta'
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'roslyn' ),
				'description' => esc_html__( 'Choose image layout when it appears in Elated Product List - Masonry layout shortcode', 'roslyn' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'roslyn' ),
					'small'              => esc_html__( 'Small', 'roslyn' ),
					'large-width'        => esc_html__( 'Large Width', 'roslyn' ),
					'large-height'       => esc_html__( 'Large Height', 'roslyn' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'roslyn' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'roslyn' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'roslyn' ),
				'options'       => roslyn_elated_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'roslyn' ),
				'parent'        => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_elated_map_woocommerce_meta', 99 );
}