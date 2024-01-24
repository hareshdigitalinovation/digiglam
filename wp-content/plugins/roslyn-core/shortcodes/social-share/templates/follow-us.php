<div class="eltdf-social-share-holder eltdf-dropdown eltdf-follow-us-wrapper">
	<a class="eltdf-social-share-dropdown-opener" href="javascript:void(0)">
		<?php echo roslyn_elated_icon_collections()->renderIcon( 'fa fa-chevron-down', 'font_awesome' ); ?>
		<span><?php esc_attr_e('follow', 'roslyn-core'); ?></span>
	</a>
	<div class="eltdf-social-share-dropdown eltdf-follow-us">
		<ul>
			<?php foreach ($networks as $net) {
				echo wp_kses($net, array(
					'li'   => array(
						'class' => true
					),
					'a'    => array(
						'itemprop' => true,
						'class'    => true,
						'href'     => true,
						'target'   => true,
						'onclick'  => true
					),
					'img'  => array(
						'itemprop' => true,
						'class'    => true,
						'src'      => true,
						'alt'      => true
					),
					'span' => array(
						'class' => true
					)
				));
			} ?>
		</ul>
		<?php
		if (!empty($link_text)) { ?>
			<a href="<?php esc_html($link);?>" class="eltdf-social-share-link"><?php echo esc_html($link_text); ?></a>
		<?php }	?>
	</div>
</div>