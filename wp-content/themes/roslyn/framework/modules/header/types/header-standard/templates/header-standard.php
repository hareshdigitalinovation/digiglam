<?php do_action('roslyn_elated_before_page_header'); ?>

<header class="eltdf-page-header">
	<?php do_action('roslyn_elated_after_page_header_html_open'); ?>
	
	<?php if($show_fixed_wrapper) : ?>
		<div class="eltdf-fixed-wrapper">
	<?php endif; ?>
			
	<div class="eltdf-menu-area <?php echo esc_attr($menu_area_position_class); ?>">
		<?php do_action('roslyn_elated_after_header_menu_area_html_open') ?>
		
		<?php if($menu_area_in_grid) : ?>
			<div class="eltdf-grid">
		<?php endif; ?>
				
			<div class="eltdf-vertical-align-containers">
				<div class="eltdf-position-left"><!--
				 --><div class="eltdf-position-left-inner">
						<?php if(!$hide_logo) {
							roslyn_elated_get_logo();
						} ?>
						<?php if($menu_area_position === 'left') : ?>
							<?php roslyn_elated_get_main_menu(); ?>
						<?php endif; ?>
					</div>
				</div>
				<?php if($menu_area_position === 'center') : ?>
					<div class="eltdf-position-center"><!--
					 --><div class="eltdf-position-center-inner">
							<?php roslyn_elated_get_main_menu(); ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="eltdf-position-right"><!--
				 --><div class="eltdf-position-right-inner">
						<?php if($menu_area_position === 'right') : ?>
							<?php roslyn_elated_get_main_menu(); ?>
						<?php endif; ?>
						<?php roslyn_elated_get_header_widget_menu_area(); ?>
					</div>
				</div>
			</div>
			
		<?php if($menu_area_in_grid) : ?>
			</div>
		<?php endif; ?>
	</div>
			
	<?php if($show_fixed_wrapper) { ?>
		</div>
	<?php } ?>
	
	<?php if($show_sticky) {
		roslyn_elated_get_sticky_header();
	} ?>
	
	<?php do_action('roslyn_elated_before_page_header_html_close'); ?>
</header>

<?php do_action('roslyn_elated_after_page_header'); ?>