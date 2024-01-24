<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="eltdf-post-content">
		<div class="eltdf-post-text">
			<div class="eltdf-post-text-inner">
				<div class="eltdf-post-text-main">
					<div class="eltdf-post-mark">
						<span class="fa fa-quote-right eltdf-quote-mark"></span>
					</div>
					<?php roslyn_elated_get_module_template_part( 'templates/parts/post-type/quote', 'blog', '', $part_params ); ?>
				</div>
				<div class="eltdf-post-additional-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
</article>