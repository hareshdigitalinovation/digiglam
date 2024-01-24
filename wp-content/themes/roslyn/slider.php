<?php
do_action( 'roslyn_elated_before_slider_action' );

$eltdf_slider_shortcode = get_post_meta( roslyn_elated_get_page_id(), 'eltdf_page_slider_meta', true );

if ( ! empty( $eltdf_slider_shortcode ) ) { ?>
	<div class="eltdf-slider">
		<div class="eltdf-slider-inner">
			<?php echo do_shortcode( wp_kses_post( $eltdf_slider_shortcode ) ); // XSS OK ?>
		</div>
	</div>
<?php }

do_action( 'roslyn_elated_after_slider_action' );
?>