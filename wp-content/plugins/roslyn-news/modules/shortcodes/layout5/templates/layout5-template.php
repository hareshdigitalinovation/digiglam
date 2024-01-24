<?php
    $alignment =  $alignment === 'left' ? 'left' : 'center';
?>

<div class="eltdf-news-item eltdf-layout5-item eltdf-item-space">
	<div class="eltdf-ni-inner">
		<div class="eltdf-ni-image-holder">
			<?php echo roslyn_news_get_shortcode_inner_template_part( 'image', '', $params ); ?>
			<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/hot-trending', '', array_merge( $params, array( 'display_hot_trending_text' => true ) ) ); ?>
		</div>
		<div class="eltdf-ni-content" style="text-align:<?php echo wp_kses_post($alignment);?>">
			<div class="eltdf-ni-info eltdf-ni-info-top">
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/date', '', $params ); ?>
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/category', '', $params ); ?>
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/comments', '', $params ); ?>
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/like', '', $params ); ?>
			</div>
			<?php echo roslyn_news_get_shortcode_inner_template_part( 'title', '', $params ); ?>
			<?php echo roslyn_news_get_shortcode_inner_template_part( 'excerpt', '', $params ); ?>
			<div class="eltdf-ni-info eltdf-ni-info-bottom">
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/read-more', '', $params ); ?>
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/author', '', $params ); ?>
				<?php echo roslyn_news_get_shortcode_inner_template_part( 'post-info/share', '', $params ); ?>
			</div>
		</div>
	</div>
</div>