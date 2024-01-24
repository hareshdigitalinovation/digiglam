<?php

if ( ! function_exists( 'roslyn_elated_set_search_fullscreen_global_option' ) ) {
    /**
     * This function set search type value for search options map
     */
    function roslyn_elated_set_search_fullscreen_global_option( $search_type_options ) {
        $search_type_options['fullscreen'] = esc_html__( 'Fullscreen', 'roslyn' );

        return $search_type_options;
    }

    add_filter( 'roslyn_elated_search_type_global_option', 'roslyn_elated_set_search_fullscreen_global_option' );
}