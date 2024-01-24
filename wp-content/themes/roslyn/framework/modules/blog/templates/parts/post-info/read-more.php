<?php if ( ! roslyn_elated_post_has_read_more() && ! post_password_required() ) { ?>
	<div class="eltdf-post-read-more-button">
		<?php
			$button_params = array(
				'type'         => 'outline',
				'link'         => get_the_permalink(),
				'text'         => esc_html__( 'READ MORE', 'roslyn' ),
				'custom_class' => 'eltdf-blog-list-button',
                'size'         => 'small'
			);
			
			echo roslyn_elated_return_button_html( $button_params );
		?>
	</div>
<?php } ?>