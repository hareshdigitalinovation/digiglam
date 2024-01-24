<?php

if ( ! function_exists( 'roslyn_news_map_review_meta' ) ) {
	function roslyn_news_map_review_meta() {
		
		$review_meta_box = roslyn_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'name'  => 'review_meta',
				'title' => esc_html__( 'Reviews', 'roslyn-news' )
			)
		);
		
		roslyn_elated_add_repeater_field(
			array(
				'name'        => 'news_post_review_fields',
				'parent'      => $review_meta_box,
				'button_text' => esc_html__( 'Add Review', 'roslyn-news' ),
				'fields'      => array(
					array(
						'type'  => 'text',
						'name'  => 'news_post_review_title',
						'label' => esc_html__( 'Review Title', 'roslyn-news' )
					),
					array(
						'type'        => 'text',
						'name'        => 'news_post_review_value',
						'label'       => esc_html__( 'Review Value', 'roslyn-news' ),
						'description' => esc_html__( 'Value from 1 to 5', 'roslyn-news' )
					)
				)
			)
		);
		
		roslyn_elated_create_meta_box_field(
			array(
				'name'        => 'news_post_review_summary',
				'type'        => 'text',
				'label'       => esc_html__( 'Review Summary', 'roslyn-news' ),
				'description' => esc_html__( 'Enter summary text for reviews', 'roslyn-news' ),
				'parent'      => $review_meta_box
			)
		);
	}
	
	add_action( 'roslyn_elated_meta_boxes_map', 'roslyn_news_map_review_meta', 35 );
}