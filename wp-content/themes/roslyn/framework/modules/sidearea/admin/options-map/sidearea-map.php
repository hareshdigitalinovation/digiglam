<?php

if (!function_exists('roslyn_elated_sidearea_options_map')) {
    function roslyn_elated_sidearea_options_map() {

        roslyn_elated_add_admin_page(
            array(
                'slug'  => '_side_area_page',
                'title' => esc_html__('Side Area', 'roslyn'),
                'icon'  => 'fa fa-indent'
            )
        );

        $side_area_panel = roslyn_elated_add_admin_panel(
            array(
                'title' => esc_html__('Side Area', 'roslyn'),
                'name'  => 'side_area',
                'page'  => '_side_area_page'
            )
        );

        roslyn_elated_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_type',
                'default_value' => 'side-menu-slide-from-right',
                'label'         => esc_html__('Side Area Type', 'roslyn'),
                'description'   => esc_html__('Choose a type of Side Area', 'roslyn'),
                'options'       => array(
                    'side-menu-slide-from-right'       => esc_html__('Slide from Right Over Content', 'roslyn'),
                    'side-menu-slide-with-content'     => esc_html__('Slide from Right With Content', 'roslyn'),
                    'side-area-uncovered-from-content' => esc_html__('Side Area Uncovered from Content', 'roslyn'),
                ),
            )
        );

        roslyn_elated_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'text',
                'name'          => 'side_area_width',
                'default_value' => '',
                'label'         => esc_html__('Side Area Width', 'roslyn'),
                'description'   => esc_html__('Enter a width for Side Area (px or %). Default width: 405px.', 'roslyn'),
                'args'          => array(
                    'col_width' => 3,
                )
            )
        );

        $side_area_width_container = roslyn_elated_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_width_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_type' => 'side-menu-slide-from-right',
                    )
                )
            )
        );

        roslyn_elated_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'color',
                'name'          => 'side_area_content_overlay_color',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Color', 'roslyn'),
                'description'   => esc_html__('Choose a background color for a content overlay', 'roslyn'),
            )
        );

        roslyn_elated_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'text',
                'name'          => 'side_area_content_overlay_opacity',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Transparency', 'roslyn'),
                'description'   => esc_html__('Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)', 'roslyn'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        roslyn_elated_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_icon_source',
                'default_value' => 'icon_pack',
                'label'         => esc_html__('Select Side Area Icon Source', 'roslyn'),
                'description'   => esc_html__('Choose whether you would like to use icons from an icon pack or SVG icons', 'roslyn'),
                'options'       => roslyn_elated_get_icon_sources_array()
            )
        );

        $side_area_icon_pack_container = roslyn_elated_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_icon_pack_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'icon_pack'
                    )
                )
            )
        );

        roslyn_elated_add_admin_field(
            array(
                'parent'        => $side_area_icon_pack_container,
                'type'          => 'select',
                'name'          => 'side_area_icon_pack',
                'default_value' => 'font_elegant',
                'label'         => esc_html__('Side Area Icon Pack', 'roslyn'),
                'description'   => esc_html__('Choose icon pack for Side Area icon', 'roslyn'),
                'options'       => roslyn_elated_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'dripicons', 'simple_line_icons'))
            )
        );

        $side_area_svg_icons_container = roslyn_elated_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_svg_icons_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'svg_path'
                    )
                )
            )
        );

        roslyn_elated_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_icon_svg_path',
                'label'       => esc_html__('Side Area Icon SVG Path', 'roslyn'),
                'description' => esc_html__('Enter your Side Area icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'roslyn'),
            )
        );

        roslyn_elated_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_close_icon_svg_path',
                'label'       => esc_html__('Side Area Close Icon SVG Path', 'roslyn'),
                'description' => esc_html__('Enter your Side Area close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'roslyn'),
            )
        );

        $side_area_icon_style_group = roslyn_elated_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'side_area_icon_style_group',
                'title'       => esc_html__('Side Area Icon Style', 'roslyn'),
                'description' => esc_html__('Define styles for Side Area icon', 'roslyn')
            )
        );

        $side_area_icon_style_row1 = roslyn_elated_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row1'
            )
        );

        roslyn_elated_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_color',
                'label'  => esc_html__('Color', 'roslyn')
            )
        );

        roslyn_elated_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_hover_color',
                'label'  => esc_html__('Hover Color', 'roslyn')
            )
        );

        $side_area_icon_style_row2 = roslyn_elated_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row2',
                'next'   => true
            )
        );

        roslyn_elated_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_color',
                'label'  => esc_html__('Close Icon Color', 'roslyn')
            )
        );

        roslyn_elated_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_hover_color',
                'label'  => esc_html__('Close Icon Hover Color', 'roslyn')
            )
        );

        roslyn_elated_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'color',
                'name'        => 'side_area_background_color',
                'label'       => esc_html__('Background Color', 'roslyn'),
                'description' => esc_html__('Choose a background color for Side Area', 'roslyn')
            )
        );

        roslyn_elated_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'text',
                'name'        => 'side_area_padding',
                'label'       => esc_html__('Padding', 'roslyn'),
                'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'roslyn'),
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

        roslyn_elated_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'selectblank',
                'name'          => 'side_area_aligment',
                'default_value' => '',
                'label'         => esc_html__('Text Alignment', 'roslyn'),
                'description'   => esc_html__('Choose text alignment for side area', 'roslyn'),
                'options'       => array(
                    ''       => esc_html__('Default', 'roslyn'),
                    'left'   => esc_html__('Left', 'roslyn'),
                    'center' => esc_html__('Center', 'roslyn'),
                    'right'  => esc_html__('Right', 'roslyn')
                )
            )
        );
    }

    add_action('roslyn_elated_options_map', 'roslyn_elated_sidearea_options_map', 8);
}