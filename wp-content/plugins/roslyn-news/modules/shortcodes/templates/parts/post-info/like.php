<?php
$display_like = isset( $display_like ) && $display_like !== '' ? $display_like : 'yes';

if ( $display_like === 'yes' ) { ?>
	<div class="eltdf-blog-like">
		<?php if ( function_exists( 'roslyn_elated_get_like' ) ) {
			roslyn_elated_get_like();
		} ?>
	</div>
<?php } ?>