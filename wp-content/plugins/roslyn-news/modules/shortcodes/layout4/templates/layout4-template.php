<div class="eltdf-news-item eltdf-layout4-item eltdf-item-space">
	<div class="eltdf-ni-inner">
		<div class="eltdf-ni-image-holder">
			<div class="eltdf-ni-image-inner">
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'image', '', $params ); ?>
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/hot-trending', '', array_merge( $params, array( 'display_hot_trending_text' => true ) ) ); ?>
			</div>
		</div>
		<div class="eltdf-ni-content">
			<div class="eltdf-ni-content-inner">
				<div class="eltdf-ni-info eltdf-ni-info-top">
					<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/date', '', $params ); ?>
					<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/category', '', $params ); ?>
					<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/like', '', $params ); ?>
					<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/comments', '', $params ); ?>
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
</div>