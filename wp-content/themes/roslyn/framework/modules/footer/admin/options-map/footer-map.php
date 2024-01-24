<?php

if ( ! function_exists( 'roslyn_elated_footer_options_map' ) ) {
	function roslyn_elated_footer_options_map() {

		roslyn_elated_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'roslyn' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = roslyn_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'roslyn' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

		roslyn_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'roslyn' ),
				'parent'        => $footer_panel
			)
		);

        roslyn_elated_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'uncovering_footer',
                'default_value' => 'no',
                'label'         => esc_html__( 'Uncovering Footer', 'roslyn' ),
                'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'roslyn' ),
                'parent'        => $footer_panel,
            )
        );

		roslyn_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'roslyn' ),
				'parent'        => $footer_panel,
			)
		);
		
		$show_footer_top_container = roslyn_elated_add_admin_container(
			array(
				'name'       => 'show_footer_top_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_top' => 'yes'
					)
				)
			)
		);

		roslyn_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '3 3 3 3',
				'label'         => esc_html__( 'Footer Top Columns', 'roslyn' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'roslyn' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3',
                    '3 3 6' => '3 (25% + 25% + 50%)',
					'3 3 3 3' => '4'
				)
			)
		);

		roslyn_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'roslyn' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'roslyn' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'roslyn' ),
					'left'   => esc_html__( 'Left', 'roslyn' ),
					'center' => esc_html__( 'Center', 'roslyn' ),
					'right'  => esc_html__( 'Right', 'roslyn' )
				),
				'parent'        => $show_footer_top_container,
			)
		);

		roslyn_elated_add_admin_field(
			array(
				'name'        => 'footer_top_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'roslyn' ),
				'description' => esc_html__( 'Set background color for top footer area', 'roslyn' ),
				'parent'      => $show_footer_top_container
			)
		);

		roslyn_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'roslyn' ),
				'parent'        => $footer_panel,
			)
		);

		$show_footer_bottom_container = roslyn_elated_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'parent'          => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_bottom'  => 'yes'
					)
				)
			)
		);

		roslyn_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '6 6',
				'label'         => esc_html__( 'Footer Bottom Columns', 'roslyn' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'roslyn' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3'
				),
				'parent'        => $show_footer_bottom_container,
			)
		);

		roslyn_elated_add_admin_field(
			array(
				'name'        => 'footer_bottom_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'roslyn' ),
				'description' => esc_html__( 'Set background color for bottom footer area', 'roslyn' ),
				'parent'      => $show_footer_bottom_container
			)
		);
	}

	add_action( 'roslyn_elated_options_map', 'roslyn_elated_footer_options_map', 9 );
}