<div class="eltdf-news-review-item">
	<div class="eltdf-review-item-title">
		<?php echo esc_html( $title ); ?>
	</div>
	<div class="eltdf-review-item-value">
		<?php echo roslyn_news_get_template_part( 'template/stars', 'review', '', array( 'style' => $stars_style ) ); ?>
	</div>
</div>