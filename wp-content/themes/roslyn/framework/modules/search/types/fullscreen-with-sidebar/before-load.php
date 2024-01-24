<?php

if ( ! function_exists( 'roslyn_elated_set_search_fullscreen_with_sidebar_global_option' ) ) {
    /**
     * This function set search type value for search options map
     */
    function roslyn_elated_set_search_fullscreen_with_sidebar_global_option( $search_type_options ) {
        $search_type_options['fullscreen-with-sidebar'] = esc_html__( 'Fullscreen With Sidebar', 'roslyn' );

        return $search_type_options;
    }

    add_filter( 'roslyn_elated_search_type_global_option', 'roslyn_elated_set_search_fullscreen_with_sidebar_global_option' );
}


if ( ! function_exists( 'roslyn_elated_register_search_sidebar' ) ) {
    function roslyn_elated_register_search_sidebar(){

        register_sidebar(
            array(
                'id' => 'fullscreen_search_column_1',
                'name' => esc_html__('FullScreen Search Column 1', 'roslyn'),
                'description' => esc_html__('Widgets added here will appear in the first column of fullscreen search', 'roslyn'),
                'before_widget' => '<div id="%1$s" class="widget eltdf-fullscreen-search-column-1 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="eltdf-widget-title-holder"><h5 class="eltdf-widget-title">',
                'after_title' => '</h5></div>'
            )
        );

        register_sidebar(
            array(
                'id' => 'fullscreen_search_column_2',
                'name' => esc_html__('FullScreen Search Column 2', 'roslyn'),
                'description' => esc_html__('Widgets added here will appear in the second column of fullscreen search', 'roslyn'),
                'before_widget' => '<div id="%1$s" class="widget eltdf-fullscreen-search-column-2 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="eltdf-widget-title-holder"><h5 class="eltdf-widget-title">',
                'after_title' => '</h5></div>'
            )
        );

        register_sidebar(
            array(
                'id' => 'fullscreen_search_column_3',
                'name' => esc_html__('FullScreen Search Column 3', 'roslyn'),
                'description' => esc_html__('Widgets added here will appear in the third column of fullscreen search', 'roslyn'),
                'before_widget' => '<div id="%1$s" class="widget eltdf-fullscreen-search-column-3 %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="eltdf-widget-title-holder"><h6 class="eltdf-widget-title">',
                'after_title' => '</h6></div>'
            )
        );
    }

    add_action( 'widgets_init', 'roslyn_elated_register_search_sidebar' );
}