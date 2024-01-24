<?php
/*
Template Name: WooCommerce
*/
?>
<?php
$eltdf_sidebar_layout = roslyn_elated_sidebar_layout();

get_header();
roslyn_elated_get_title();
get_template_part( 'slider' );
do_action('roslyn_elated_before_main_content');

//Woocommerce content
if ( ! is_singular( 'product' ) ) { ?>
	<div class="eltdf-container">
		<div class="eltdf-container-inner clearfix">
			<div class="eltdf-grid-row">
				<div <?php echo roslyn_elated_get_content_sidebar_class(); ?>>
					<?php roslyn_elated_woocommerce_content(); ?>
				</div>
				<?php if ( $eltdf_sidebar_layout !== 'no-sidebar' ) { ?>
					<div <?php echo roslyn_elated_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="eltdf-container">
		<div class="eltdf-container-inner clearfix">
			<?php roslyn_elated_woocommerce_content(); ?>
		</div>
	</div>
<?php } ?>
<?php get_footer(); ?>