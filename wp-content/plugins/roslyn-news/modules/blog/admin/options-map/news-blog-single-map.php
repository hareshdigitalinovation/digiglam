<?php

if ( ! function_exists( 'roslyn_news_blog_single_options_map' ) ) {
	function roslyn_news_blog_single_options_map( $panel_blog_single ) {
		roslyn_elated_add_admin_field(
			array(
				'name'          => 'news_post_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Post Template', 'roslyn-news' ),
				'description'   => esc_html__( 'Choose post template', 'roslyn-news' ),
				'default_value' => '',
				'parent'        => $panel_blog_single,
				'options'       => array(
					''              => esc_html__( 'Default', 'roslyn-news' ),
					'image-full'    => esc_html__( 'Featured Image Full Width', 'roslyn-news' ),
					'info-on-image' => esc_html__( 'Info on Featured Image', 'roslyn-news' ),
				)
			)
		);
	}
	
	add_action( 'roslyn_elated_blog_single_options_map', 'roslyn_news_blog_single_options_map', 5 );
}