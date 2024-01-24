<div class="eltdf-slide-from-header-bottom-holder">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<div class="eltdf-form-holder">
			<input type="text" placeholder="<?php esc_attr_e( 'Search', 'roslyn' ); ?>" name="s" class="eltdf-search-field" autocomplete="off" />
			<button type="submit" <?php roslyn_elated_class_attribute( $search_submit_icon_class ); ?>>
				<?php echo roslyn_elated_get_search_icon_html(); ?>
			</button>
		</div>
	</form>
</div>