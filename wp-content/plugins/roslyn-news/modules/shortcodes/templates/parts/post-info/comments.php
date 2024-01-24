<?php
$display_comments = isset( $display_comments ) && $display_comments !== '' ? $display_comments : 'yes';

if ( $display_comments === 'yes' && comments_open() ) { ?>
	<div class="eltdf-post-info-comments-holder">
		<a itemprop="url" class="eltdf-post-info-comments" href="<?php comments_link(); ?>">
			<span class="eltdf-comments"><?php comments_number( '0 ' . esc_html__( ' COMMENTS', 'roslyn-news' ), '1 ' . esc_html__( ' COMMENT', 'roslyn-news' ), '% ' . esc_html__( ' COMMENTS', 'roslyn-news' ) ); ?></span>
		</a>
	</div>
<?php } ?>