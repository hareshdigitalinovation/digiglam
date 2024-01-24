<?php

if ( ! function_exists( 'roslyn_elated_register_header_bottom_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function roslyn_elated_register_header_bottom_type( $header_types ) {
		$header_type = array(
			'header-bottom' => 'RoslynElated\Modules\Header\Types\HeaderBottom'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'roslyn_elated_init_register_header_bottom_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function roslyn_elated_init_register_header_bottom_type() {
		add_filter( 'roslyn_elated_register_header_type_class', 'roslyn_elated_register_header_bottom_type' );
	}
	
	add_action( 'roslyn_elated_before_header_function_init', 'roslyn_elated_init_register_header_bottom_type' );
}


if ( ! function_exists( 'roslyn_elated_get_header_bottom_main_menu' ) ) {
    /**
     * Loads vertical menu HTML
     */
    function roslyn_elated_get_header_bottom_main_menu() {
        roslyn_elated_get_module_template_part( 'templates/header-bottom-navigation', 'header/types/header-bottom' );
    }
}

if ( ! function_exists( 'roslyn_elated_get_header_bottom_navigation_widget_areas' ) ) {
    /**
     * Loads header widgets area HTML
     */
    function roslyn_elated_get_header_bottom_navigation_widget_areas() {
        $page_id                            = roslyn_elated_get_page_id();
        $custom_vertical_header_widget_area = get_post_meta( $page_id, 'eltdf_custom_vertical_area_sidebar_meta', true );

        if ( is_active_sidebar( 'bottom_menu_navigation_area' ) && empty( $custom_vertical_header_widget_area ) ) {
            dynamic_sidebar( 'bottom_menu_navigation_area' );
        } else if ( ! empty( $custom_vertical_header_widget_area ) && is_active_sidebar( $custom_vertical_header_widget_area ) ) {
            dynamic_sidebar( $custom_vertical_header_widget_area );
        }
    }
}

if ( ! function_exists( 'roslyn_elated_header_bottom_holder_class' ) ) {
    /**
     * Return holder class for this header type html
     */
    function roslyn_elated_header_bottom_holder_class() {
        $center_content = roslyn_elated_get_meta_field_intersect( 'vertical_header_center_content', roslyn_elated_get_page_id() );
        $holder_class   = $center_content === 'yes' ? 'eltdf-vertical-alignment-center' : 'eltdf-vertical-alignment-top';

        return $holder_class;
    }
}

if ( ! function_exists( 'roslyn_elated_register_header_bottom_widgets' ) ) {
    /**
     * Registers additional widget areas for this header type
     */
    function roslyn_elated_register_header_bottom_widgets() {
        register_sidebar(
            array(
                'id'            => 'bottom_menu_left_area',
                'name'          => esc_html__( 'Bottom Menu Left', 'roslyn' ),
                'description'   => esc_html__( 'This widget area is rendered on the left in bottom menu', 'roslyn' ),
                'before_widget' => '<div class="%2$s eltdf-bottom-menu-left-widget">',
                'after_widget'  => '</div>',
                'before_title'  => '<h5 class="eltdf-widget-title">',
                'after_title'   => '</h5>'
            )
        );

        register_sidebar(
            array(
                'id'            => 'bottom_menu_right_area',
                'name'          => esc_html__( 'Bottom Menu Right', 'roslyn' ),
                'description'   => esc_html__( 'This widget area is rendered on the right in bottom menu', 'roslyn' ),
                'before_widget' => '<div class="%2$s eltdf-bottom-menu-right-widget">',
                'after_widget'  => '</div>',
                'before_title'  => '<h5 class="eltdf-widget-title">',
                'after_title'   => '</h5>'
            )
        );

        register_sidebar(
            array(
                'id'            => 'bottom_menu_navigation_area',
                'name'          => esc_html__( 'Bottom Menu Navigation', 'roslyn' ),
                'description'   => esc_html__( 'This widget area is rendered inside bottom menu navigation', 'roslyn' ),
                'before_widget' => '<div class="%2$s eltdf-bottom-menu-navigation-widget">',
                'after_widget'  => '</div>',
                'before_title'  => '<h5 class="eltdf-widget-title">',
                'after_title'   => '</h5>'
            )
        );
    }

    if ( roslyn_elated_check_is_header_type_enabled( 'header-bottom' ) ) {
        add_action( 'widgets_init', 'roslyn_elated_register_header_bottom_widgets' );
    }
}

if ( ! function_exists( 'roslyn_elated_header_bottom_per_page_custom_styles' ) ) {
    /**
     * Return header per page styles
     */
    function roslyn_elated_header_bottom_per_page_custom_styles( $style, $class_prefix, $page_id ) {
        $header_area_style    = array();
        $header_area_selector = array( $class_prefix . '.eltdf-header-bottom .eltdf-vertical-menu-nav-holder-outer' );

        $vertical_header_background_color  = get_post_meta( $page_id, 'eltdf_vertical_header_background_color_meta', true );
        $disable_vertical_background_image = get_post_meta( $page_id, 'eltdf_disable_vertical_header_background_image_meta', true );
        $vertical_background_image         = get_post_meta( $page_id, 'eltdf_vertical_header_background_image_meta', true );
        $vertical_shadow                   = get_post_meta( $page_id, 'eltdf_vertical_header_shadow_meta', true );
        $vertical_border                   = get_post_meta( $page_id, 'eltdf_vertical_header_border_meta', true );

        if ( ! empty( $vertical_header_background_color ) ) {
            $header_area_style['background-color'] = $vertical_header_background_color;
        }

        if ( $disable_vertical_background_image == 'yes' ) {
            $header_area_style['background-image'] = 'none';
        } elseif ( $vertical_background_image !== '' ) {
            $header_area_style['background-image'] = 'url(' . $vertical_background_image . ')';
        }

        if ( $vertical_shadow == 'yes' ) {
            $header_area_style['box-shadow'] = '1px 0 3px rgba(0, 0, 0, 0.05)';
        }

        if ( $vertical_border == 'yes' ) {
            $header_border_color = get_post_meta( $page_id, 'eltdf_vertical_header_border_color_meta', true );

            if ( $header_border_color !== '' ) {
                $header_area_style['border-left'] = '1px solid ' . $header_border_color;
            }
        }

        $current_style = '';

        if ( ! empty( $header_area_style ) ) {
            $current_style .= roslyn_elated_dynamic_css( $header_area_selector, $header_area_style );
        }

        $current_style = $current_style . $style;

        return $current_style;
    }

    add_filter( 'roslyn_elated_add_header_page_custom_style', 'roslyn_elated_header_bottom_per_page_custom_styles', 10, 3 );
}