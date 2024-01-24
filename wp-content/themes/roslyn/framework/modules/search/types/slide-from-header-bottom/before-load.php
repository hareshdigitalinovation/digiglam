<?php

if ( ! function_exists( 'roslyn_elated_set_search_slide_from_hb_global_option' ) ) {
    /**
     * This function set search type value for search options map
     */
    function roslyn_elated_set_search_slide_from_hb_global_option( $search_type_options ) {
        $search_type_options['slide-from-header-bottom'] = esc_html__( 'Slide From Header Bottom', 'roslyn' );

        return $search_type_options;
    }

    add_filter( 'roslyn_elated_search_type_global_option', 'roslyn_elated_set_search_slide_from_hb_global_option' );
}