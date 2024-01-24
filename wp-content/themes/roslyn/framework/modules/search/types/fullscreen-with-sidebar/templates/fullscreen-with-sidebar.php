<div class="eltdf-fullscreen-with-sidebar-search-holder">
	<a <?php roslyn_elated_class_attribute( $search_close_icon_class ); ?> href="javascript:void(0)">
		<?php echo roslyn_elated_get_search_close_icon_html(); ?>
	</a>
	<div class="eltdf-fullscreen-search-table">
		<div class="eltdf-fullscreen-search-cell">
			<div class="eltdf-fullscreen-search-inner  <?php echo esc_attr($search_in_grid); ?>">
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="eltdf-fullscreen-search-form" method="get">
					<div class="eltdf-form-holder">
						<div class="eltdf-form-holder-inner">
							<div class="eltdf-field-holder">
								<input type="text" placeholder="<?php esc_attr_e( 'Search...', 'roslyn' ); ?>" name="s" class="eltdf-search-field" autocomplete="off"/>
							</div>
							<button type="submit" <?php roslyn_elated_class_attribute( $search_submit_icon_class ); ?>>
								<?php echo roslyn_elated_get_search_icon_html(); ?>
							</button>
						</div>
					</div>
				</form>
                <div class="eltdf-fullscreen-sidebar">
                    <?php roslyn_elated_get_fullscreen_sidebar(); ?>
                </div>
			</div>
		</div>
	</div>
</div>