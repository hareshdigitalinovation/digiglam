<?php
$month = get_the_time( 'm' );
$year  = get_the_time( 'Y' );
$title = get_the_title();

$date_format  = isset( $date_format ) && $date_format !== '' ? $date_format : 'published';
$difference   = human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . esc_html__( ' ago', 'roslyn-news' );
$display_date = isset( $display_date ) && $display_date !== '' ? $display_date : 'yes';

if ( $display_date == 'yes' ) { ?>
	<div itemprop="dateCreated" class="eltdf-post-info-date entry-date published updated">
		<?php if ( empty( $title ) && roslyn_elated_blog_item_has_link() ) { ?>
			<a itemprop="url" href="<?php the_permalink() ?>">
		<?php } else { ?>
			<a itemprop="url" href="<?php echo get_month_link( $year, $month ); ?>">
		<?php } ?>
				<?php if ( $date_format == 'published' ) {
					the_time( get_option( 'date_format' ) );
				} else {
					echo esc_html( $difference );
				} ?>
		</a>
		<meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number( roslyn_elated_get_page_id() ); ?>" />
	</div>
<?php } ?>