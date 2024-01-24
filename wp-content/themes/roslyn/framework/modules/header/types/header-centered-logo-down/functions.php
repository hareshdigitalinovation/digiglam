<?php

if ( ! function_exists( 'roslyn_elated_register_header_centered_logo_down_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function roslyn_elated_register_header_centered_logo_down_type( $header_types ) {
		$header_type = array(
			'header-centered-logo-down' => 'RoslynElated\Modules\Header\Types\HeaderCenteredLogoDown'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'roslyn_elated_init_register_header_centered_logo_down_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function roslyn_elated_init_register_header_centered_logo_down_type() {
		add_filter( 'roslyn_elated_register_header_type_class', 'roslyn_elated_register_header_centered_logo_down_type' );
	}
	
	add_action( 'roslyn_elated_before_header_function_init', 'roslyn_elated_init_register_header_centered_logo_down_type' );
}

if ( ! function_exists( 'roslyn_elated_header_centered_logo_down_per_page_custom_styles' ) ) {
	/**
	 * Return header per page styles
	 */
	function roslyn_elated_header_centered_logo_down_per_page_custom_styles( $style, $class_prefix, $page_id ) {
		$header_area_style    = array();
		$header_area_selector = array( $class_prefix . '.eltdf-header-centered-logo-down .eltdf-logo-area .eltdf-logo-wrapper' );
		
		$logo_area_logo_padding = get_post_meta( $page_id, 'eltdf_logo_wrapper_padding_header_centered_logo_down_meta', true );
		
		if ( $logo_area_logo_padding !== '' ) {
			$header_area_style['padding'] = $logo_area_logo_padding;
		}
		
		$current_style = '';
		
		if ( ! empty( $header_area_style ) ) {
			$current_style .= roslyn_elated_dynamic_css( $header_area_selector, $header_area_style );
		}
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'roslyn_elated_add_header_page_custom_style', 'roslyn_elated_header_centered_logo_down_per_page_custom_styles', 10, 3 );
}

if ( ! function_exists( 'roslyn_elated_register_header_centered_logo_down_widgets' ) ) {
	/**
	 * Registers additional widget areas for this header type
	 */
	function roslyn_elated_register_header_centered_logo_down_widgets() {
		register_sidebar(
			array(
				'id'            => 'centered_header_logo_down_left',
				'name'          => esc_html__( 'Centered with Logo down Header Left', 'roslyn' ),
				'description'   => esc_html__( 'This widget area is rendered on the left of the centered with logo down header logo area.', 'roslyn' ),
				'before_widget' => '<div class="%2$s eltdf-centered-logo-down-menu-left-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="eltdf-widget-title">',
				'after_title'   => '</h5>'
			)
		);

		register_sidebar(
			array(
				'id'            => 'centered_header_logo_down_right',
				'name'          => esc_html__( 'Centered with Logo Down Header Right', 'roslyn' ),
				'description'   => esc_html__( 'This widget area is rendered on the right of the centered with logo down header logo area.', 'roslyn' ),
				'before_widget' => '<div class="%2$s eltdf-centered-logo-down-menu-right-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="eltdf-widget-title">',
				'after_title'   => '</h5>'
			)
		);
	}

	if ( roslyn_elated_check_is_header_type_enabled( 'header-centered-logo-down' ) ) {
		add_action( 'widgets_init', 'roslyn_elated_register_header_centered_logo_down_widgets' );
	}
}