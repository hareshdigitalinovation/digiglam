<section class="eltdf-side-menu">
    <div class="eltdf-side-area-inner">
        <div class="eltdf-close-side-menu-holder">
            <a <?php roslyn_elated_class_attribute( $side_area_close_icon_class ); ?> href="#">
		        <?php echo roslyn_elated_get_side_area_close_icon_html(); ?>
            </a>
        </div>
		<?php if ( is_active_sidebar( 'sidearea' ) ) {
			dynamic_sidebar( 'sidearea' );
		} ?>
    </div>
    <div class="eltdf-side-area-bottom">
		<?php if ( is_active_sidebar( 'sidearea-bottom' ) ) {
			dynamic_sidebar( 'sidearea-bottom' );
		} ?>
    </div>
</section>