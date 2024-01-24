<div class="eltdf-post-read-more-button">
	<?php
	if ( roslyn_elated_core_plugin_installed() ) {
		echo roslyn_elated_get_button_html(
			apply_filters(
				'roslyn_elated_blog_template_read_more_button',
				array(
					'type'         => 'simple',
					'size'         => 'medium',
					'link'         => get_the_permalink(),
					'text'         => esc_html__( 'READ MORE', 'roslyn-news' ),
					'custom_class' => 'eltdf-blog-list-button'
				)
			)
		);
	} else { ?>
		<a itemprop="url" class="eltdf-btn eltdf-btn-medium eltdf-btn-simple eltdf-blog-list-button" href="<?php echo esc_url( get_the_permalink() ); ?>">
            <span class="eltdf-btn-text"><?php echo esc_html__( 'READ MORE', 'roslyn-news' ); ?></span>
		</a>
	<?php } ?>
</div>
