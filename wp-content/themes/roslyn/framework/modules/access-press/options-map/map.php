<?php

if ( ! function_exists( 'roslyn_elated_accespress_options_map' ) ) {
    /**
     * General options page
     */
    function roslyn_elated_accespress_options_map() {

        roslyn_elated_add_admin_page(
            array(
                'slug'  => '_accesspress',
                'icon'  => 'fa fa-institution',
                'title' => esc_html__( 'AccessPress', 'roslyn' )
            )
        );

        $panel_ap_style = roslyn_elated_add_admin_panel(
            array(
                'page'  => '_accesspress',
                'name'  => 'panel_ap_style',
                'title' => esc_html__( 'AccesPress Options', 'roslyn' )
            )
        );

        roslyn_elated_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'accesspress_style',
                'default_value' => 'no',
                'label'         => esc_html__( 'Use our predefined style for icons', 'roslyn' ),
                'parent'        => $panel_ap_style
            )
        );
    }

    add_action( 'roslyn_elated_options_map', 'roslyn_elated_accespress_options_map', 30 );
}