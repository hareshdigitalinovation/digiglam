<?php
if ( ! function_exists( 'roslyn_elated_header_bottom_margin_styles' ) ) {
    /**
     * Generates styles for menu area
     */
    function roslyn_elated_header_bottom_margin_styles() {

        $menu_area_bottom_selectors = array(
            '.eltdf-header-bottom .eltdf-page-header'
        );
        $menu_area_bottom_styles = array();

        $menu_area_height = roslyn_elated_options()->getOptionValue( 'menu_area_height' );
        if ( $menu_area_height !== '' ) {
            $menu_area_bottom_styles['margin-top'] = '-' . roslyn_elated_filter_px( $menu_area_height ) . 'px';
        }

        echo roslyn_elated_dynamic_css( $menu_area_bottom_selectors, $menu_area_bottom_styles );

    }

    add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_header_bottom_margin_styles' );
}

if ( ! function_exists( 'roslyn_elated_header_bottom_menu_styles' ) ) {
    function roslyn_elated_header_bottom_menu_styles() {
        $vertical_header_styles = array();

        $vertical_header_selectors = array(
            '.eltdf-header-bottom .eltdf-vertical-menu-nav-holder-outer'
        );

        $vertical_background_color = roslyn_elated_options()->getOptionValue( 'vertical_header_background_color' );
        $vertical_background_image = roslyn_elated_options()->getOptionValue( 'vertical_header_background_image' );
        $vertical_shadow_enabled   = roslyn_elated_options()->getOptionValue( 'vertical_header_shadow' );
        $vertical_border_enabled   = roslyn_elated_options()->getOptionValue( 'vertical_header_border' );

        if ( ! empty( $vertical_background_color ) ) {
            $vertical_header_styles['background-color'] = $vertical_background_color;
        }

        if ( ! empty( $vertical_background_image ) ) {
            $vertical_header_styles['background-image'] = 'url(' . esc_url( $vertical_background_image ) . ')';
        }

        if ( $vertical_shadow_enabled === 'yes' ) {
            $vertical_header_styles['box-shadow'] = '1px 0 3px rgba(0, 0, 0, 0.05)';
        }

        if ( $vertical_border_enabled === 'yes' ) {
            $header_border_color = roslyn_elated_options()->getOptionValue( 'vertical_header_border_color' );

            if ( ! empty( $header_border_color ) ) {
                $vertical_header_styles['border-left'] = '1px solid ' . $header_border_color;
            }
        }

        echo roslyn_elated_dynamic_css( $vertical_header_selectors, $vertical_header_styles );
    }

    add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_header_bottom_menu_styles' );
}

if ( ! function_exists( 'roslyn_elated_header_bottom_main_menu_styles' ) ) {
    /**
     * Generates styles for vertical main main menu
     */
    function roslyn_elated_header_bottom_main_menu_styles() {

        // vertical menu 1st level style

        $first_level_styles = roslyn_elated_get_typography_styles( 'vertical_menu_1st' );

        $first_level_selector = array(
            '.eltdf-header-bottom nav.eltdf-header-bottom-menu > ul > li > a'
        );

        echo roslyn_elated_dynamic_css( $first_level_selector, $first_level_styles );

        $first_level_hover_styles = array();

        $first_level_hover_color = roslyn_elated_options()->getOptionValue( 'vertical_menu_1st_hover_color' );
        if ( ! empty( $first_level_hover_color ) ) {
            $first_level_hover_styles['color'] = $first_level_hover_color;
        }

        $first_level_hover_selector = array(
            '.eltdf-header-bottom nav.eltdf-header-bottom-menu > ul > li > a:hover',
            '.eltdf-header-bottom nav.eltdf-header-bottom-menu > ul > li > a.eltdf-active-item',
            '.eltdf-header-bottom nav.eltdf-header-bottom-menu > ul > li > a.current-menu-ancestor'
        );

        echo roslyn_elated_dynamic_css( $first_level_hover_selector, $first_level_hover_styles );

        // vertical menu 2nd level style

        $second_level_styles = roslyn_elated_get_typography_styles( 'vertical_menu_2nd' );

        $second_level_selector = array(
            '.eltdf-header-bottom nav.eltdf-header-bottom-menu ul li ul li a'
        );

        echo roslyn_elated_dynamic_css( $second_level_selector, $second_level_styles );

        $second_level_hover_styles = array();

        $second_level_hover_color = roslyn_elated_options()->getOptionValue( 'vertical_menu_2nd_hover_color' );
        if ( ! empty( $second_level_hover_color ) ) {
            $second_level_hover_styles['color'] = $second_level_hover_color;
        }

        $second_level_hover_selector = array(
            '.eltdf-header-bottom nav.eltdf-header-bottom-menu ul li ul li a:hover',
            '.eltdf-header-bottom nav.eltdf-header-bottom-menu ul li ul li.current-menu-ancestor > a',
            '.eltdf-header-bottom nav.eltdf-header-bottom-menu ul li ul li.current-menu-item > a'
        );

        echo roslyn_elated_dynamic_css( $second_level_hover_selector, $second_level_hover_styles );

        // vertical menu 3rd level style

        $third_level_styles = roslyn_elated_get_typography_styles( 'vertical_menu_3rd' );

        $third_level_selector = array(
            '.eltdf-header-vertical-sliding nav.eltdf-header-bottom-menu ul li ul li ul li a'
        );

        echo roslyn_elated_dynamic_css( $third_level_selector, $third_level_styles );


        $third_level_hover_styles = array();

        $third_level_hover_color = roslyn_elated_options()->getOptionValue( 'vertical_menu_3rd_hover_color' );
        if ( ! empty( $third_level_hover_color ) ) {
            $third_level_hover_styles['color'] = $third_level_hover_color;
        }

        $third_level_hover_selector = array(
            '.eltdf-header-bottom nav.eltdf-header-bottom-menu ul li ul li ul li a:hover',
            '.eltdf-header-bottom nav.eltdf-header-bottom-menu ul li ul li ul li.current-menu-ancestor > a',
            '.eltdf-header-bottom nav.eltdf-header-bottom-menu ul li ul li ul li.current-menu-item > a'
        );

        echo roslyn_elated_dynamic_css( $third_level_hover_selector, $third_level_hover_styles );
    }

    add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_header_bottom_main_menu_styles' );
}