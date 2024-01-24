<?php
if ( post_password_required() ) {
	echo get_the_password_form();
} else {
	$excerpt_length = isset( $params['excerpt_length'] ) ? $params['excerpt_length'] : '';
	$excerpt        = roslyn_elated_excerpt( $excerpt_length );
	
	if ( ! empty( $excerpt ) ) { ?>
		<div class="eltdf-post-excerpt-holder">
			<p itemprop="description" class="eltdf-post-excerpt">
				<?php echo wp_kses_post( $excerpt ); ?>
			</p>
		</div>
	<?php }
} ?>