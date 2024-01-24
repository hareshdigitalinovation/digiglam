<div class="eltdf-post-single-<?php echo esc_attr( $blog_single_type ); ?>">
	<?php roslyn_news_blog_single_top_part( $blog_single_type ); ?>
	<div class="eltdf-grid">
		<div class="eltdf-grid-row <?php echo esc_attr( $holder_classes ); ?>">
			<div <?php echo roslyn_elated_get_content_sidebar_class(); ?>>
				<div class="eltdf-blog-holder eltdf-blog-single <?php echo esc_attr( $blog_single_classes ); ?>">
					<?php roslyn_news_blog_single_type( $blog_single_type ); ?>
				</div>
			</div>
			<?php if ( $sidebar_layout !== 'no-sidebar' ) { ?>
				<div <?php echo roslyn_elated_get_sidebar_holder_class(); ?>>
					<?php get_sidebar(); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>