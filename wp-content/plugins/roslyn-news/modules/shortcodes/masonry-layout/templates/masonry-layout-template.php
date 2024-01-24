<div class="eltdf-news-item eltdf-masonry-layout-item eltdf-item-space <?php echo esc_attr( $post_info['class'] ) ?>">
	<div class="eltdf-ni-inner">
		<div class="eltdf-ni-image-holder">
			<?php echo roslyn_news_get_shortcode_inner_template_part( 'image', '', $post_info ); ?>
			<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/hot-trending', '', array_merge( $params, array( 'display_hot_trending_text' => true ) ) ); ?>
		</div>
		<div class="eltdf-ni-content">
			<div class="eltdf-ni-info eltdf-ni-info-top">
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/date', '', $params ); ?>
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/category', '', $params ); ?>
			</div>
			<?php echo roslyn_news_get_shortcode_inner_template_part( 'title', '', $params ); ?>
			<?php echo roslyn_news_get_shortcode_inner_template_part( 'excerpt', '', $params ); ?>
			<div class="eltdf-ni-info eltdf-ni-info-bottom">
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/author', '', $params ); ?>
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/share', '', $params ); ?>
			</div>
		</div>
	</div>
</div>