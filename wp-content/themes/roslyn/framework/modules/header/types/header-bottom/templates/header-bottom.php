<?php do_action('roslyn_elated_before_page_header'); ?>
<header class="eltdf-page-header">
    <?php do_action('roslyn_elated_after_page_header_html_open'); ?>
    <div class="eltdf-fixed-wrapper">
        <div class="eltdf-menu-area">
            <?php do_action('roslyn_elated_after_header_menu_area_html_open') ?>

            <?php if($menu_area_in_grid) : ?>
                <div class="eltdf-grid">
            <?php endif; ?>

                <div class="eltdf-vertical-align-containers">
                    <div class="eltdf-position-left"><!--
                     --><div class="eltdf-position-left-inner">
                            <?php if(is_active_sidebar( 'bottom_menu_left_area' ) ) : ?>
                                <div class="eltdf-bottom-menu-left-widget-holder">
                                    <?php dynamic_sidebar('bottom_menu_left_area'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if(!$hide_logo) {
                                roslyn_elated_get_logo();
                            } ?>
                            <?php roslyn_elated_get_main_menu(); ?>
                        </div>
                    </div>
                    <div class="eltdf-position-right"><!--
                     --><div class="eltdf-position-right-inner">
                            <?php if(is_active_sidebar( 'bottom_menu_right_area' ) ) : ?>
                                <?php dynamic_sidebar('bottom_menu_right_area'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            <?php if($menu_area_in_grid) : ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php do_action('roslyn_elated_before_page_header_html_close'); ?>
</header>
<?php do_action('roslyn_elated_after_page_header'); ?>