<?php ?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="eltdf-search-slide-window-top" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="eltdf-grid">
	<?php } ?>
		<div class="eltdf-search-form-inner">
			<span <?php roslyn_elated_class_attribute( $search_submit_icon_class ); ?>>
				<?php echo roslyn_elated_get_search_icon_html(); ?>
			</span>
			<input type="text" placeholder="<?php esc_attr_e( 'Search', 'roslyn' ); ?>" name="s" class="eltdf-swt-search-field" autocomplete="off"/>
			<a <?php roslyn_elated_class_attribute( $search_close_icon_class ); ?> href="#">
				<?php echo roslyn_elated_get_search_close_icon_html(); ?>
			</a>
		</div>
	<?php if ( $search_in_grid ) { ?>
	</div>
	<?php } ?>
</form>