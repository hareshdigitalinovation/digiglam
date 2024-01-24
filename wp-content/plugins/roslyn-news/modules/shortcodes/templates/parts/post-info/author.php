<?php
$display_author = isset( $display_author ) && $display_author !== '' ? $display_author : 'yes';
if ( !isset($display_author_style) ){
	$display_author_style = '';
}
$author_style =  $display_author_style === 'yes' ? 'eltdf-author-style' : '';

if ( $display_author == 'yes' && $display_author !='') { ?>
	<div class="eltdf-post-info-author <?php echo esc_attr($author_style); ?>">
		<span class="eltdf-post-info-author-text">
			<?php esc_html_e( 'BY', 'roslyn-news' ); ?>
		</span>
		<a itemprop="author" class="eltdf-post-info-author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
			<?php the_author_meta( 'display_name' ); ?>
		</a>
	</div>
<?php } ?>