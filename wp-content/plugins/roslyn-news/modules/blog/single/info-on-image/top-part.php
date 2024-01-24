<div class="eltdf-news-post-top-holder">
	<?php echo roslyn_news_get_blog_part( 'parts/image', 'templates', '', $part_params ); ?>
	<div class="eltdf-news-post-top-info-holder">
		<div class="eltdf-news-post-top-table">
			<div class="eltdf-news-post-top-table-cell">
				<div class="eltdf-news-post-single-info">
					<?php echo roslyn_news_get_blog_part( 'parts/post-info/category', 'templates', '', $part_params ); ?>
					<?php echo roslyn_news_get_blog_part( 'parts/post-info/date', 'templates', '', $part_params ); ?>
				</div>
				<?php echo roslyn_news_get_blog_part( 'parts/title', 'templates', '', $part_params ); ?>
				<div class="eltdf-news-post-single-info">
					<?php echo roslyn_news_get_blog_part( 'parts/post-info/author', 'templates', '', $part_params ); ?>
					<?php echo roslyn_news_get_blog_part( 'parts/post-info/comments', 'templates', '', $part_params ); ?>
					<?php echo roslyn_news_get_blog_part( 'parts/post-info/views', 'templates', '', $part_params ); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="eltdf-npt-info-bottom">
		<?php echo roslyn_news_get_blog_part( 'parts/post-info/hot-trending', 'templates', '', array(
			'display_hot_trending_icons' => 'yes',
			'display_hot_trending_text'  => true
		) ); ?>
	</div>
</div>