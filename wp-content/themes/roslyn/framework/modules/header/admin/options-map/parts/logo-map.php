<?php

if ( ! function_exists( 'roslyn_elated_logo_options_map' ) ) {
	function roslyn_elated_logo_options_map() {
		
		roslyn_elated_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'roslyn' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = roslyn_elated_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'roslyn' )
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'roslyn' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'roslyn' )
			)
		);
		
		$hide_logo_container = roslyn_elated_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'dependency' => array(
					'hide' => array(
						'hide_logo'  => 'yes'
					)
				)
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'roslyn' ),
				'parent'        => $hide_logo_container
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'roslyn' ),
				'parent'        => $hide_logo_container
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => ELATED_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'roslyn' ),
				'parent'        => $hide_logo_container
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'roslyn' ),
				'parent'        => $hide_logo_container
			)
		);
		
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'roslyn' ),
				'parent'        => $hide_logo_container
			)
		);
	}
	
	add_action( 'roslyn_elated_options_map', 'roslyn_elated_logo_options_map', 2 );
}