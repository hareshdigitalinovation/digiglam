<?php if(comments_open()) { ?>
	<div class="eltdf-post-info-comments-holder">
		<a itemprop="url" class="eltdf-post-info-comments" href="<?php comments_link(); ?>">
			<?php comments_number('0 ' . esc_html__('Comments','roslyn'), '1 '.esc_html__('Comment','roslyn'), '% '.esc_html__('Comments','roslyn') ); ?>
		</a>
	</div>
<?php } ?>