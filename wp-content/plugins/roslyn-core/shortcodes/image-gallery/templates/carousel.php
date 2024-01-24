<?php
$i    = 0;
$rand = rand(0,1000);
?>
<div class="eltdf-image-gallery <?php echo esc_attr($holder_classes); ?>">
	<div class="eltdf-ig-slider eltdf-owl-slider" <?php echo roslyn_elated_get_inline_attrs($slider_data); ?>>
		<?php foreach ($images as $image) { ?>
			<div class="eltdf-ig-image">
				<?php if ($image_behavior === 'lightbox') { ?>
					<a itemprop="image" class="eltdf-ig-lightbox eltdf-block-drag-link" href="<?php echo esc_url($image['url']); ?>" data-rel="prettyPhoto[image_gallery_pretty_photo-<?php echo esc_attr($rand); ?>]" title="<?php echo esc_attr($image['title']); ?>">
				<?php } else if ($image_behavior === 'custom-link' && !empty($custom_links)) { ?>
					<a itemprop="url" class="eltdf-ig-custom-link eltdf-block-drag-link" href="<?php echo esc_url($custom_links[$i++]); ?>" target="<?php echo esc_attr($custom_link_target); ?>" title="<?php echo esc_attr($image['title']); ?>">
				<?php } ?>
					<?php if(is_array($image_size) && count($image_size)) :
						echo roslyn_elated_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]);
					else:
						echo wp_get_attachment_image($image['image_id'], $image_size);
					endif; ?>
				<?php if ($image_behavior === 'lightbox' || $image_behavior === 'custom-link') { ?>
					</a>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>