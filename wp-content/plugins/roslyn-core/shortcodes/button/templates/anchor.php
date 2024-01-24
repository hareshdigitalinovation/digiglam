<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php roslyn_elated_inline_style($button_styles); ?> <?php roslyn_elated_class_attribute($button_classes); ?> <?php echo roslyn_elated_get_inline_attrs($button_data); ?> <?php echo roslyn_elated_get_inline_attrs($button_custom_attrs); ?>>
    <span class="eltdf-btn-text"><?php echo esc_html($text); ?></span>
	<?php if($type = 'outline' || $type = 'simple') { ?>
        <span class="eltdf-btn-line" <?php roslyn_elated_inline_style($line_styles); ?>></span>
	<?php } ?>
    <?php echo roslyn_elated_icon_collections()->renderIcon($icon, $icon_pack); ?>
</a>