<?php
$image_size          = isset( $image_size ) ? $image_size : 'thumbnail';
$featured_image_meta = get_post_meta( get_the_ID(), 'eltdf_blog_list_featured_image_meta', true );
$has_featured        = ! empty( $featured_image_meta ) || has_post_thumbnail();
$blog_list_image_id  = ! empty( $featured_image_meta ) ? roslyn_elated_get_attachment_id_from_url( $featured_image_meta ) : '';
?>
<?php if ( $has_featured ) { ?>
	<div class="eltdf-post-image">
		<a itemprop="url" href="<?php echo get_the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php
			if ( $image_size != 'custom' ) {
				if ( ! empty( $blog_list_image_id ) ) {
					echo wp_get_attachment_image( $blog_list_image_id, $image_size );
				} else {
					the_post_thumbnail( $image_size );
				}
			} elseif ( $custom_image_width != '' && $custom_image_height != '' ) {
				if ( ! empty( $blog_list_image_id ) ) {
					echo roslyn_elated_generate_thumbnail( $blog_list_image_id, null, $custom_image_width, $custom_image_height );
				} else {
					echo roslyn_elated_generate_thumbnail( get_post_thumbnail_id( get_the_ID() ), null, $custom_image_width, $custom_image_height );
				}
			}
			?>
		</a>
	</div>
<?php } ?>