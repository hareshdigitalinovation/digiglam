<?php
$display_author = isset( $display_author ) && $display_author !== '' ? $display_author : 'yes';

if ( $display_author == 'yes' ) { ?>
	<div class="eltdf-post-info-author">
		<span class="eltdf-post-info-author-text">
			<?php esc_html_e( 'By', 'roslyn-news' ); ?>
		</span>
		<a itemprop="author" class="eltdf-post-info-author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
			<?php the_author_meta( 'display_name' ); ?>
		</a>
	</div>
<?php } ?>