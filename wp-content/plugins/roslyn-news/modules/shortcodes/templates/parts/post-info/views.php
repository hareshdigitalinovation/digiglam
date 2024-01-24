<?php
$views         = roslyn_news_get_post_count_views( get_the_ID() );
$display_views = isset( $display_views ) && $display_views !== '' ? $display_views : 'yes';

if ( intval( $views ) > 1000 ) {
	$views = round( $views / 1000, 2 ) . esc_html__( 'k', 'roslyn-news' );
}

if ( $display_views == 'yes' ) { ?>
	<div class="eltdf-views-holder">
		<i class="fa fa-eye"></i>
		<span class="eltdf-views"><?php echo esc_html( $views ) ?></span>
	</div>
<?php } ?>