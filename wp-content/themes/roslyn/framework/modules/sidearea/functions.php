<?php
if (!function_exists('roslyn_elated_register_side_area_sidebar')) {
    /**
     * Register side area sidebar
     */
    function roslyn_elated_register_side_area_sidebar() {
        register_sidebar(
            array(
                'id'            => 'sidearea',
                'name'          => esc_html__('Side Area', 'roslyn'),
                'description'   => esc_html__('Side Area', 'roslyn'),
                'before_widget' => '<div id="%1$s" class="widget eltdf-sidearea %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="eltdf-widget-title-holder"><h5 class="eltdf-widget-title">',
                'after_title'   => '</h5></div>'
            )
        );
    }

    add_action('widgets_init', 'roslyn_elated_register_side_area_sidebar');
}

if ( ! function_exists( 'roslyn_elated_register_side_area_bottom' ) ) {
	/**
	 * Register side area sidebar
	 */
	function roslyn_elated_register_side_area_bottom() {
		register_sidebar(
			array(
				'id'            => 'sidearea-bottom',
				'name'          => esc_html__( 'Side Area Bottom', 'roslyn' ),
				'description'   => esc_html__( 'Side Area Bottom', 'roslyn' ),
				'before_widget' => '<div id="%1$s" class="widget eltdf-sidearea-bottom %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="eltdf-widget-title-holder"><h4 class="eltdf-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
	}

	add_action( 'widgets_init', 'roslyn_elated_register_side_area_bottom' );
}

if (!function_exists('roslyn_elated_side_menu_body_class')) {
    /**
     * Function that adds body classes for different side menu styles
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */
    function roslyn_elated_side_menu_body_class($classes) {

        if (is_active_widget(false, false, 'eltdf_side_area_opener')) {

            if (roslyn_elated_options()->getOptionValue('side_area_type')) {

                $classes[] = 'eltdf-' . roslyn_elated_options()->getOptionValue('side_area_type');

            }

        }

        return $classes;
    }

    add_filter('body_class', 'roslyn_elated_side_menu_body_class');
}

if (!function_exists('roslyn_elated_get_side_area')) {
    /**
     * Loads side area HTML
     */
    function roslyn_elated_get_side_area() {

        if (is_active_widget(false, false, 'eltdf_side_area_opener')) {

            $parameters = array(
                'side_area_close_icon_class' => roslyn_elated_get_side_area_close_icon_class()
            );

            roslyn_elated_get_module_template_part('templates/sidearea', 'sidearea', '', $parameters);
        }
    }

    add_action('roslyn_elated_after_body_tag', 'roslyn_elated_get_side_area', 10);
}

if (!function_exists('roslyn_elated_get_side_area_close_class')) {
    /**
     * Loads side area close icon class
     */
    function roslyn_elated_get_side_area_close_icon_class() {

        $side_area_icon_source = roslyn_elated_options()->getOptionValue('side_area_icon_source');

        $side_area_close_icon_class_array = array(
            'eltdf-close-side-menu'
        );

        $side_area_close_icon_class_array[] = $side_area_icon_source == 'icon_pack' ? 'eltdf-close-side-menu-icon-pack' : 'eltdf-close-side-menu-svg-path';

        return $side_area_close_icon_class_array;
    }
}

if (!function_exists('roslyn_elated_get_side_area_close_icon_html')) {
    /**
     * Loads side area close icon HTML
     */
    function roslyn_elated_get_side_area_close_icon_html() {

        $side_area_icon_source = roslyn_elated_options()->getOptionValue('side_area_icon_source');
        $side_area_icon_pack = roslyn_elated_options()->getOptionValue('side_area_icon_pack');
        $side_area_close_icon_svg_path = roslyn_elated_options()->getOptionValue('side_area_close_icon_svg_path');

        $side_area_close_icon_html = '';

        if (($side_area_icon_source == 'icon_pack') && isset($side_area_icon_pack)) {
            $side_area_close_icon_html .= roslyn_elated_icon_collections()->getMenuCloseIcon($side_area_icon_pack);
        } else if (isset($side_area_close_icon_svg_path)) {
            $side_area_close_icon_html .= $side_area_close_icon_svg_path;
        }

        return $side_area_close_icon_html;
    }
}