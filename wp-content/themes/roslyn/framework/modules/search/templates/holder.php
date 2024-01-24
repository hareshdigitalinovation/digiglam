<div class="eltdf-grid-row">
	<div <?php echo roslyn_elated_get_content_sidebar_class(); ?>>
		<div class="eltdf-search-page-holder">
			<?php roslyn_elated_get_search_page_layout(); ?>
		</div>
		<?php do_action( 'roslyn_elated_page_after_content' ); ?>
	</div>
	<?php if ( $sidebar_layout !== 'no-sidebar' ) { ?>
		<div <?php echo roslyn_elated_get_sidebar_holder_class(); ?>>
			<?php get_sidebar(); ?>
		</div>
	<?php } ?>
</div>