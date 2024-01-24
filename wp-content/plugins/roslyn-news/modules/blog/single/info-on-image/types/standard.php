<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="eltdf-post-content">
		<div class="eltdf-post-text">
			<div class="eltdf-post-text-inner">
				<div class="eltdf-post-text-main">
					<?php the_content(); ?>
					<?php do_action( 'roslyn_elated_single_link_pages' ); ?>
				</div>
			</div>
		</div>
	</div>
</article>