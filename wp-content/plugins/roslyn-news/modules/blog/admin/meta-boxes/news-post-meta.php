<?php

if ( ! function_exists( 'roslyn_news_map_post_meta' ) ) {
	function roslyn_news_map_post_meta( $post_meta_box ) {
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_news_post_template_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Post Template', 'roslyn-news' ),
				'description'   => esc_html__( 'Choose post template', 'roslyn-news' ),
				'parent'        => $post_meta_box,
				'options'       => array(
					''              => esc_html__( 'Default', 'roslyn-news' ),
					'image-full'    => esc_html__( 'Featured Image Full Width', 'roslyn-news' ),
					'info-on-image' => esc_html__( 'Info on Featured Image', 'roslyn-news' ),
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'news_post_featured_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Featured Post', 'roslyn-news' ),
				'description'   => esc_html__( 'Choose whether post is featured or not', 'roslyn-news' ),
				'parent'        => $post_meta_box
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'news_post_trending_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Trending Post', 'roslyn-news' ),
				'description'   => esc_html__( 'Choose whether post is trending or not', 'roslyn-news' ),
				'parent'        => $post_meta_box
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'          => 'news_post_hot_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hot Post', 'roslyn-news' ),
				'description'   => esc_html__( 'Choose whether post is hot or not', 'roslyn-news' ),
				'parent'        => $post_meta_box
			)
		);
	}
	
	add_action( 'roslyn_elated_blog_post_meta', 'roslyn_news_map_post_meta', 5, 1 );
}