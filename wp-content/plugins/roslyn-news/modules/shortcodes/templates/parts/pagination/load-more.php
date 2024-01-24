<?php
    if ( $pagination_skin == 'light-pagination' ) {
        $pagSkin = 'eltdf-' . $pagination_skin . '-skin';
    }
?>

<?php if ( $query_result->max_num_pages > 1 ) { ?>
	<div class="eltdf-spinner eltdf-rotate-line eltdf-hide-spinner"></div>
	<div class="eltdf-news-load-more-pagination <?php echo esc_attr($pagSkin); ?>">
		<?php
		if ( roslyn_elated_core_plugin_installed() ) {
			echo roslyn_elated_get_button_html(
				apply_filters(
					'roslyn_news_shortcodes_load_more',
					array(
						'link' => 'javascript: void(0)',
						'size' => 'large',
						'type' => 'outline',
						'text' => esc_html__( 'Load more', 'roslyn-news' )
					)
				)
			);
		} else { ?>
			<a itemprop="url" class="eltdf-btn eltdf-btn-large eltdf-btn-outline" href="javascript:void(0)">
                <span class="eltdf-btn-text"><?php echo esc_html__( 'Load more', 'roslyn-news' ); ?></span>
			</a>
		<?php } ?>
	</div>
<?php }