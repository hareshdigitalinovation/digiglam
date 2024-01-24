<?php
$display_categories = isset( $display_categories ) && $display_categories !== '' ? $display_categories : 'yes';

if ( $display_categories == 'yes' ) { ?>
	<div class="eltdf-post-info-category">
		<?php the_category( ', ' ); ?>
	</div>
<?php } ?>