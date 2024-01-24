<?php

if ( ! function_exists( 'roslyn_elated_include_mobile_header_menu' ) ) {
	function roslyn_elated_include_mobile_header_menu( $menus ) {
		$menus['mobile-navigation'] = esc_html__( 'Mobile Navigation', 'roslyn' );
		
		return $menus;
	}
	
	add_filter( 'roslyn_elated_register_headers_menu', 'roslyn_elated_include_mobile_header_menu' );
}

if ( ! function_exists( 'roslyn_elated_register_mobile_header_areas' ) ) {
	/**
	 * Registers widget areas for mobile header
	 */
	function roslyn_elated_register_mobile_header_areas() {
		if ( roslyn_elated_is_responsive_on() && roslyn_elated_core_plugin_installed() ) {
			register_sidebar(
				array(
					'id'            => 'eltdf-right-from-mobile-logo',
					'name'          => esc_html__( 'Mobile Header Widget Area', 'roslyn' ),
					'description'   => esc_html__( 'Widgets added here will appear on the right hand side from the mobile logo on mobile header', 'roslyn' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s eltdf-right-from-mobile-logo">',
					'after_widget'  => '</div>'
				)
			);
		}
	}
	
	add_action( 'widgets_init', 'roslyn_elated_register_mobile_header_areas' );
}

if ( ! function_exists( 'roslyn_elated_mobile_header_class' ) ) {
	function roslyn_elated_mobile_header_class( $classes ) {
		$classes[] = 'eltdf-default-mobile-header';
		
		$classes[] = 'eltdf-sticky-up-mobile-header';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'roslyn_elated_mobile_header_class' );
}

if ( ! function_exists( 'roslyn_elated_get_mobile_header' ) ) {
	/**
	 * Loads mobile header HTML only if responsiveness is enabled
	 */
	function roslyn_elated_get_mobile_header( $slug = '', $module = '' ) {
		if ( roslyn_elated_is_responsive_on() ) {
			$mobile_menu_title = roslyn_elated_options()->getOptionValue( 'mobile_menu_title' );
			$has_navigation    = has_nav_menu( 'main-navigation' ) || has_nav_menu( 'mobile-navigation' ) ? true : false;
			
			$parameters = array(
				'show_navigation_opener' => $has_navigation,
				'mobile_menu_title'      => $mobile_menu_title,
				'mobile_icon_class'		 => roslyn_elated_get_mobile_navigation_icon_class()
			);

            $module = apply_filters('roslyn_elated_mobile_menu_module', 'header/types/mobile-header');
            $slug = apply_filters('roslyn_elated_mobile_menu_slug', '');
            $parameters = apply_filters('roslyn_elated_mobile_menu_parameters', $parameters);

            roslyn_elated_get_module_template_part( 'templates/mobile-header', $module, $slug, $parameters );
		}
	}
	
	add_action( 'roslyn_elated_after_wrapper_inner', 'roslyn_elated_get_mobile_header', 20 );
}

if ( ! function_exists( 'roslyn_elated_get_mobile_logo' ) ) {
	/**
	 * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
	 */
	function roslyn_elated_get_mobile_logo() {
		$show_logo_image = roslyn_elated_options()->getOptionValue( 'hide_logo' ) === 'yes' ? false : true;
		
		if ( $show_logo_image ) {
			$mobile_logo_image = roslyn_elated_get_meta_field_intersect( 'logo_image_mobile', roslyn_elated_get_page_id() );
			
			//check if mobile logo has been set and use that, else use normal logo
			$logo_image = ! empty( $mobile_logo_image ) ? $mobile_logo_image : roslyn_elated_get_meta_field_intersect( 'logo_image', roslyn_elated_get_page_id() );
			
			//get logo image dimensions and set style attribute for image link.
			$logo_dimensions = roslyn_elated_get_image_dimensions( $logo_image );
			
			$logo_height = '';
			$logo_styles = '';
			if ( is_array( $logo_dimensions ) && array_key_exists( 'height', $logo_dimensions ) ) {
				$logo_height = $logo_dimensions['height'];
				$logo_styles = 'height: ' . intval( $logo_height / 2 ) . 'px'; //divided with 2 because of retina screens
			}
			
			//set parameters for logo
			$parameters = array(
				'logo_image'      => $logo_image,
				'logo_dimensions' => $logo_dimensions,
				'logo_height'     => $logo_height,
				'logo_styles'     => $logo_styles
			);
			
			roslyn_elated_get_module_template_part( 'templates/mobile-logo', 'header/types/mobile-header', '', $parameters );
		}
	}
}

if ( ! function_exists( 'roslyn_elated_get_mobile_nav' ) ) {
	/**
	 * Loads mobile navigation HTML
	 */
	function roslyn_elated_get_mobile_nav() {
		roslyn_elated_get_module_template_part( 'templates/mobile-navigation', 'header/types/mobile-header' );
	}
}

if ( ! function_exists( 'roslyn_elated_mobile_header_per_page_js_var' ) ) {
    function roslyn_elated_mobile_header_per_page_js_var( $perPageVars ) {
        $perPageVars['eltdfMobileHeaderHeight'] = roslyn_elated_set_default_mobile_menu_height_for_header_types();

        return $perPageVars;
    }

    add_filter( 'roslyn_elated_per_page_js_vars', 'roslyn_elated_mobile_header_per_page_js_var' );
}

if ( ! function_exists( 'roslyn_elated_get_mobile_navigation_icon_class' ) ) {
	/**
	 * Loads mobile navigation icon class
	 */
	function roslyn_elated_get_mobile_navigation_icon_class() {

		$mobile_icon_icon_source = roslyn_elated_options()->getOptionValue( 'mobile_icon_icon_source' );

		$mobile_icon_class_array = array(
			'eltdf-mobile-menu-opener'
		);

		$mobile_icon_class_array[] = $mobile_icon_icon_source == 'icon_pack' ? 'eltdf-mobile-menu-opener-icon-pack' : 'eltdf-mobile-menu-opener-svg-path';

		return $mobile_icon_class_array;
	}
}

if ( ! function_exists( 'roslyn_elated_get_mobile_navigation_icon_html' ) ) {
	/**
	 * Loads mobile navigation icon HTML
	 */
	function roslyn_elated_get_mobile_navigation_icon_html() {

		$mobile_icon_icon_source	= roslyn_elated_options()->getOptionValue( 'mobile_icon_icon_source' );
		$mobile_icon_icon_pack		= roslyn_elated_options()->getOptionValue( 'mobile_icon_icon_pack' );
		$mobile_icon_svg_path 		= roslyn_elated_options()->getOptionValue( 'mobile_icon_svg_path' );

		$mobile_navigation_icon_html = '';

		if ( ( $mobile_icon_icon_source == 'icon_pack' ) && ( isset( $mobile_icon_icon_pack ) ) ) {
			$mobile_navigation_icon_html .= roslyn_elated_icon_collections()->getMobileMenuIcon($mobile_icon_icon_pack);
		} else if ( isset( $mobile_icon_svg_path ) ) {
			$mobile_navigation_icon_html .= $mobile_icon_svg_path; 
		}

		return $mobile_navigation_icon_html;
	}
}