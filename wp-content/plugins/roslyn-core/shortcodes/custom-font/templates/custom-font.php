<<?php echo esc_attr( $title_tag ); ?> class="eltdf-custom-font-holder <?php echo esc_attr( $holder_classes ); ?>" <?php roslyn_elated_inline_style( $holder_styles ); ?> <?php echo roslyn_elated_get_inline_attrs( $holder_data ); ?>>
	<?php echo wp_kses_post( $title ); ?>
</<?php echo esc_attr( $title_tag ); ?>>