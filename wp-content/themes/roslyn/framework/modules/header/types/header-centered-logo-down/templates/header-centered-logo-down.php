<?php do_action('roslyn_elated_before_page_header'); ?>

<header class="eltdf-page-header">
	<?php do_action('roslyn_elated_after_page_header_html_open'); ?>

    <?php if($show_fixed_wrapper) : ?>
    <div class="eltdf-fixed-wrapper">
        <?php endif; ?>

        <div class="eltdf-menu-area">
            <?php do_action( 'roslyn_elated_after_header_menu_area_html_open' ); ?>

            <?php if($menu_area_in_grid) : ?>
            <div class="eltdf-grid">
                <?php endif; ?>

                <div class="eltdf-vertical-align-containers">
                    <div class="eltdf-position-left"><!--
				 --><div class="eltdf-position-left-inner">
                            <?php roslyn_elated_get_centered_header_logo_down_left_widget(); ?>
                            <?php roslyn_elated_get_main_menu(); ?>
                        </div>
                    </div>
                    <div class="eltdf-position-right"><!--
				 --><div class="eltdf-position-right-inner">
                            <?php roslyn_elated_get_centered_header_logo_down_right_widget(); ?>
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
	
    <div class="eltdf-logo-area">
	    <?php do_action( 'roslyn_elated_after_header_logo_area_html_open' ); ?>
	    
        <?php if($logo_area_in_grid) : ?>
            <div class="eltdf-grid">
        <?php endif; ?>
			
            <div class="eltdf-vertical-align-containers">
                <div class="eltdf-position-center"><!--
                 --><div class="eltdf-position-center-inner">
                        <?php if(!$hide_logo) {
                            roslyn_elated_get_logo();
                        } ?>
                    </div>
                </div>
            </div>
	            
        <?php if($logo_area_in_grid) : ?>
            </div>
        <?php endif; ?>
    </div>
	
	<?php if($show_sticky) {
		roslyn_elated_get_sticky_header('centered-logo-down', 'header/types/header-centered-logo-down');
	} ?>
	
	<?php do_action('roslyn_elated_before_page_header_html_close'); ?>
</header>

<?php do_action('roslyn_elated_after_page_header'); ?>