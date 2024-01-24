<?php

foreach ( glob( ROSLYN_NEWS_REVIEW_PATH . '/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'roslyn_news_review_html' ) ) {
	function roslyn_news_review_html( $post_ID = '' ) {
		if ( $post_ID == '' ) {
			$post_ID = get_the_ID();
		}
		
		$html = '';
		
		$review_list = get_post_meta( get_the_ID(), 'news_post_review_fields', true);

		$review_summary = get_post_meta( get_the_ID(), 'news_post_review_summary', true );
		$review_average = get_post_meta( get_the_ID(), 'roslyn_news_review_average', true );
		
		if ( $review_average !== '' && is_array($review_list) && count($review_list)) {
			
			$review_average_params['style'] = 'width: ' . ( $review_average * 20 ) . '%'; //20 is 100/5, calculating percent
			
			$review_holder_title = esc_html__( 'Review', 'roslyn-news' );
			if ( count( $review_list ) > 1 ) {
				$review_holder_title = esc_html__( 'Reviews', 'roslyn-news' );
			}
			
			$html .= '<div class="eltdf-news-reviews-holder">';
			$html .= '<div class="eltdf-news-review-title-holder">';
			$html .= '<h3 class="eltdf-news-review-title">' . esc_html( $review_holder_title ) . '</h3>';
			$html .= '<div class="eltdf-news-review-average">';
			$html .= '<span class="eltdf-news-review-no">' . $review_average . '</span>';
			$html .= roslyn_news_get_template_part( 'template/stars', 'review', '', $review_average_params );
			$html .= '</div>';
			$html .= '</div>'; //closing eltdf-news-review-title-holder
			$html .= '<div class="eltdf-news-reviews">';
			
			foreach ($review_list as $review_item) {
				if ( $review_item['news_post_review_value'] !== '' ) {
					
					
					$review_params = array();
					
					$review_params['title']       = $review_item['news_post_review_title'];
					$review_params['stars_style'] = 'width: ' . ( $review_item['news_post_review_value'] * 20 ) . '%'; //20 is 100/5, calculating percent
					
					$html .= roslyn_news_get_template_part( 'template/review', 'review', '', $review_params );
				}
			}
			
			$html .= '</div>'; //closing eltdf-news-reviews
			
			if ( $review_summary !== '' ) {
				$html .= '<div class="eltdf-news-review-summary-holder">';
				$html .= '<h3 class="eltdf-news-summary-title">' . esc_html__( 'Summary', 'roslyn-news' ) . '</h3>';
				$html .= '<div class="eltdf-news-review-summary">';
				$html .= esc_html( $review_summary );
				$html .= '</div>';
				$html .= '</div>';
			}
			
			$html .= '</div>'; //closing eltdf-news-reviews-holder
		}
		
		echo $html;
	}
	
	add_action( 'roslyn_elated_after_article_content', 'roslyn_news_review_html', 5 );
}

if ( ! function_exists( 'roslyn_news_save_review' ) ) {
	/**
	 * Function that saves meta box to postmeta table
	 *
	 * @param $post_id int id of post that meta box is being saved
	 * @param $post WP_Post current post object
	 */
	function roslyn_news_save_review( $post_id, $post ) {
		$current_review = get_post_meta( $post_id, 'roslyn_news_review_average', true );
		
		//fill review values
		$review_values = array();
		$review_list = get_post_meta( get_the_ID(), 'news_post_review_fields', true);

		if ( is_array( $review_list ) && count( $review_list ) ) {
			foreach ($review_list as $review_item) {
				$review_values[] = $review_item['news_post_review_value'];
			}
		}

		$review_average = '';
		
		if ( count( $review_values ) ) {
			$sum   = 0;
			$count = 0;
			
			foreach ( $review_values as $value ) {
				if ( $value !== '' ) {
					//prevent values higher then 5 and lower then 1
					$value = $value > 5 ? 5 : $value;
					$value = $value < 1 ? 1 : $value;
					
					$sum += $value;
					$count ++;
				}
			}
			
			if ( $count != 0 ) {
				$review_average = round( $sum / $count, 2 );
			}
		}
		
		if ( $current_review !== $review_average ) {
			update_post_meta( $post_id, 'roslyn_news_review_average', $review_average );
		}
	}
	
	add_action( 'save_post', 'roslyn_news_save_review', 5, 2 ); //action needs to be after save meta fields with 1 priority
}