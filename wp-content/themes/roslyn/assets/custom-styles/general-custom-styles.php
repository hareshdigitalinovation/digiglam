<?php

if(!function_exists('roslyn_elated_design_styles')) {
    /**
     * Generates general custom styles
     */
    function roslyn_elated_design_styles() {
	    $font_family = roslyn_elated_options()->getOptionValue( 'google_fonts' );
	    if ( ! empty( $font_family ) && roslyn_elated_is_font_option_valid( $font_family ) ) {
		    $font_family_selector = array(
			    'body'
		    );
		    echo roslyn_elated_dynamic_css( $font_family_selector, array( 'font-family' => roslyn_elated_get_font_option_val( $font_family ) ) );
	    }

		$first_main_color = roslyn_elated_options()->getOptionValue('first_color');
        if(!empty($first_main_color)) {
            $color_selector = array(
                'a:hover',
                'blockquote',
                'h1 a:hover',
                'h2 a:hover',
                'h3 a:hover',
                'h4 a:hover',
                'h5 a:hover',
                'h6 a:hover',
                'p a:hover',
                '.eltdf-comment-holder .eltdf-comment-text .comment-edit-link',
                '.eltdf-comment-holder .eltdf-comment-text .comment-reply-link',
                '.eltdf-comment-holder .eltdf-comment-text .fa-reply',
                '.eltdf-comment-holder .eltdf-comment-text .replay',
                '.eltdf-comment-holder .eltdf-comment-text #cancel-comment-reply-link',
                '.eltdf-owl-slider .owl-nav .owl-next:hover',
                '.eltdf-owl-slider .owl-nav .owl-prev:hover',
                '#eltdf-back-to-top>span:not(.eltdf-btn-line)',
                '.eltdf-fullscreen-sidebar .widget ul li a:hover',
                '.eltdf-fullscreen-sidebar .widget #wp-calendar tfoot a:hover',
                '.eltdf-fullscreen-sidebar .widget.widget_search .input-holder button:hover',
                '.eltdf-side-menu .widget ul li a:hover',
                '.eltdf-side-menu .widget #wp-calendar tfoot a:hover',
                '.eltdf-side-menu .widget.widget_search .input-holder button:hover',
                '.wpb_widgetised_column .widget #wp-calendar tfoot a',
                'aside.eltdf-sidebar .widget #wp-calendar tfoot a',
                '.widget ul li a',
                '.widget #wp-calendar tfoot a',
                '.widget_icl_lang_sel_widget .wpml-ls-legacy-dropdown .wpml-ls-item-toggle:hover',
                '.widget_icl_lang_sel_widget .wpml-ls-legacy-dropdown-click .wpml-ls-item-toggle:hover',
                '.eltdf-blog-holder article.sticky .eltdf-post-title a',
                '.eltdf-blog-holder article .eltdf-post-info-top>div a:hover',
                '.eltdf-blog-holder article.format-link .eltdf-post-mark .eltdf-link-mark',
                '.eltdf-author-description .eltdf-author-description-text-holder .eltdf-author-name a:hover',
                '.eltdf-author-description .eltdf-author-description-text-holder .eltdf-author-social-icons a:hover',
                '.eltdf-blog-list-holder .eltdf-bli-info>div a:hover',
                '.eltdf-blog-list-holder.eltdf-bl-simple .eltdf-bli-content .eltdf-post-info-category a:hover',
                '.eltdf-top-bar .widget a:hover',
                '.eltdf-main-menu>ul>li.eltdf-active-item>a',
                '.eltdf-dark-header .eltdf-page-header>div:not(.eltdf-sticky-header):not(.fixed) .eltdf-main-menu>ul>li.eltdf-active-item>a',
                '.eltdf-dark-header .eltdf-page-header>div:not(.eltdf-sticky-header):not(.fixed) .eltdf-main-menu>ul>li>a:hover',
                '.eltdf-mobile-header .eltdf-mobile-menu-opener.eltdf-mobile-menu-opened a',
                '.eltdf-mobile-header .eltdf-mobile-nav .eltdf-grid>ul>li.eltdf-active-item>a',
                '.eltdf-mobile-header .eltdf-mobile-nav .eltdf-grid>ul>li.eltdf-active-item>h6',
                '.eltdf-mobile-header .eltdf-mobile-nav ul li a:hover',
                '.eltdf-mobile-header .eltdf-mobile-nav ul li h6:hover',
                '.eltdf-mobile-header .eltdf-mobile-nav ul ul li.current-menu-ancestor>a',
                '.eltdf-mobile-header .eltdf-mobile-nav ul ul li.current-menu-ancestor>h6',
                '.eltdf-mobile-header .eltdf-mobile-nav ul ul li.current-menu-item>a',
                '.eltdf-mobile-header .eltdf-mobile-nav ul ul li.current-menu-item>h6',
                '.eltdf-search-cover .eltdf-search-close:hover',
                '.eltdf-side-menu-button-opener.opened',
                '.eltdf-side-menu-button-opener:hover',
                '.eltdf-testimonials-holder.eltdf-testimonials-image-pagination.eltdf-testimonials-light .owl-nav .owl-next:hover',
                '.eltdf-testimonials-holder.eltdf-testimonials-image-pagination.eltdf-testimonials-light .owl-nav .owl-prev:hover',
                '.eltdf-banner-holder .eltdf-banner-link-text .eltdf-banner-link-hover span',
                '.eltdf-social-share-holder.eltdf-dropdown .eltdf-social-share-dropdown-opener',
                '.eltdf-social-share-holder.eltdf-dropdown .eltdf-social-share-dropdown-opener:hover',
                '.eltdf-twitter-list-holder .eltdf-twitter-icon',
                '.eltdf-twitter-list-holder .eltdf-tweet-text a:hover',
                '.eltdf-twitter-list-holder .eltdf-twitter-profile a:hover',
                '.widget.widget_eltdf_twitter_widget .eltdf-twitter-widget li .eltdf-twitter-icon',
                '.widget.widget_eltdf_twitter_widget .eltdf-twitter-widget li .eltdf-tweet-text a:hover',
            );

            $woo_color_selector = array();
            if(roslyn_elated_is_woocommerce_installed()) {
                $woo_color_selector = array(
                    '.eltdf-pl-holder .eltdf-pli .eltdf-pli-rating',
                    '.eltdf-plc-holder .eltdf-plc-item .eltdf-plc-rating',
                    '.eltdf-pls-holder .eltdf-pls-text .eltdf-pls-rating',
                    '.eltdf-product-info .eltdf-pi-rating',
                    '.eltdf-woo-single-page .woocommerce-tabs #reviews .comment-respond .stars a.active:after',
                    '.eltdf-woo-single-page .woocommerce-tabs #reviews .comment-respond .stars a:before',
                    '.woocommerce .star-rating',
                    '.woocommerce-page .eltdf-content .eltdf-quantity-buttons .eltdf-quantity-minus:hover',
                    '.woocommerce-page .eltdf-content .eltdf-quantity-buttons .eltdf-quantity-plus:hover',
                    'div.woocommerce .eltdf-quantity-buttons .eltdf-quantity-minus:hover',
                    'div.woocommerce .eltdf-quantity-buttons .eltdf-quantity-plus:hover',
                    '.eltdf-woo-single-page .eltdf-single-product-summary .product_meta>span a:hover',
                    '.eltdf-dark-header .eltdf-page-header>div:not(.eltdf-sticky-header):not(.fixed) .eltdf-shopping-cart-holder .eltdf-header-cart:hover',
                    '.widget.woocommerce.widget_layered_nav ul li.chosen a',
                );
            }

            $color_selector = array_merge($color_selector, $woo_color_selector);

	        $color_important_selector = array(
                '.eltdf-dark-header .eltdf-page-header>div:not(.fixed):not(.eltdf-sticky-header) .eltdf-menu-area .widget a:hover',
                '.eltdf-dark-header .eltdf-page-header>div:not(.fixed):not(.eltdf-sticky-header).eltdf-menu-area .widget a:hover',
                '.eltdf-dark-header .eltdf-page-header>div:not(.eltdf-sticky-header):not(.fixed) .eltdf-search-opener:hover',
                '.eltdf-dark-header .eltdf-top-bar .eltdf-search-opener:hover',
                '.eltdf-dark-header .eltdf-page-header>div:not(.eltdf-sticky-header):not(.fixed) .eltdf-side-menu-button-opener.opened',
                '.eltdf-dark-header .eltdf-page-header>div:not(.eltdf-sticky-header):not(.fixed) .eltdf-side-menu-button-opener:hover',
                '.eltdf-dark-header .eltdf-top-bar .eltdf-side-menu-button-opener.opened',
                '.eltdf-dark-header .eltdf-top-bar .eltdf-side-menu-button-opener:hover',
                '.eltdf-dark-header .eltdf-page-header>div:not(.eltdf-sticky-header):not(.fixed) .eltdf-icon-widget-holder:hover',
                '.eltdf-dark-header .eltdf-page-header>div:not(.eltdf-sticky-header):not(.fixed) .eltdf-social-icon-widget-holder:hover',
	        );

            $background_color_selector = array(
                '.eltdf-st-loader .pulse',
                '.eltdf-st-loader .double_pulse .double-bounce1',
                '.eltdf-st-loader .double_pulse .double-bounce2',
                '.eltdf-st-loader .cube',
                '.eltdf-st-loader .rotating_cubes .cube1',
                '.eltdf-st-loader .rotating_cubes .cube2',
                '.eltdf-st-loader .stripes>div',
                '.eltdf-st-loader .wave>div',
                '.eltdf-st-loader .two_rotating_circles .dot1',
                '.eltdf-st-loader .two_rotating_circles .dot2',
                '.eltdf-st-loader .five_rotating_circles .container1>div',
                '.eltdf-st-loader .five_rotating_circles .container2>div',
                '.eltdf-st-loader .five_rotating_circles .container3>div',
                '.eltdf-st-loader .atom .ball-1:before',
                '.eltdf-st-loader .atom .ball-2:before',
                '.eltdf-st-loader .atom .ball-3:before',
                '.eltdf-st-loader .atom .ball-4:before',
                '.eltdf-st-loader .clock .ball:before',
                '.eltdf-st-loader .mitosis .ball',
                '.eltdf-st-loader .lines .line1',
                '.eltdf-st-loader .lines .line2',
                '.eltdf-st-loader .lines .line3',
                '.eltdf-st-loader .lines .line4',
                '.eltdf-st-loader .fussion .ball',
                '.eltdf-st-loader .fussion .ball-1',
                '.eltdf-st-loader .fussion .ball-2',
                '.eltdf-st-loader .fussion .ball-3',
                '.eltdf-st-loader .fussion .ball-4',
                '.eltdf-st-loader .wave_circles .ball',
                '.eltdf-st-loader .pulse_circles .ball',
                '#submit_comment:hover',
                '.post-password-form input[type=submit]:hover',
                'input.wpcf7-form-control.wpcf7-submit:hover',
                '.eltdf-blog-holder article.format-audio .eltdf-blog-audio-holder .mejs-container .mejs-controls>.mejs-time-rail .mejs-time-total .mejs-time-current',
                '.eltdf-blog-holder article.format-audio .eltdf-blog-audio-holder .mejs-container .mejs-controls>a.mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
                '.eltdf-accordion-holder.eltdf-ac-boxed .eltdf-accordion-title.ui-state-active',
                '.eltdf-accordion-holder.eltdf-ac-boxed .eltdf-accordion-title.ui-state-hover',
                '.eltdf-process-holder .eltdf-process-circle',
                '.eltdf-process-holder .eltdf-process-line',
                '.eltdf-progress-bar .eltdf-pb-content-holder .eltdf-pb-content',
                '.eltdf-tabs.eltdf-tabs-standard .eltdf-tabs-nav li.ui-state-active a',
                '.eltdf-tabs.eltdf-tabs-standard .eltdf-tabs-nav li.ui-state-hover a',
                '.eltdf-tabs.eltdf-tabs-boxed .eltdf-tabs-nav li.ui-state-active a',
                '.eltdf-tabs.eltdf-tabs-boxed .eltdf-tabs-nav li.ui-state-hover a',
            );

            $woo_background_color_selector = array();
            if(roslyn_elated_is_woocommerce_installed()) {
                $woo_background_color_selector = array(
                    '.eltdf-plc-holder .eltdf-plc-item .eltdf-plc-add-to-cart.eltdf-default-skin .added_to_cart:hover',
                    '.eltdf-plc-holder .eltdf-plc-item .eltdf-plc-add-to-cart.eltdf-default-skin .button:hover',
                    '.eltdf-plc-holder .eltdf-plc-item .eltdf-plc-add-to-cart.eltdf-light-skin .added_to_cart:hover',
                    '.eltdf-plc-holder .eltdf-plc-item .eltdf-plc-add-to-cart.eltdf-light-skin .button:hover',
                    '.eltdf-plc-holder .eltdf-plc-item .eltdf-plc-add-to-cart.eltdf-dark-skin .added_to_cart:hover',
                    '.eltdf-plc-holder .eltdf-plc-item .eltdf-plc-add-to-cart.eltdf-dark-skin .button:hover',
                    '.eltdf-pl-holder .eltdf-pli-inner .eltdf-pli-text-inner .eltdf-pli-add-to-cart.eltdf-default-skin .added_to_cart:hover',
                    '.eltdf-pl-holder .eltdf-pli-inner .eltdf-pli-text-inner .eltdf-pli-add-to-cart.eltdf-default-skin .button:hover',
                    '.eltdf-pl-holder .eltdf-pli-inner .eltdf-pli-text-inner .eltdf-pli-add-to-cart.eltdf-light-skin .added_to_cart:hover',
                    '.eltdf-pl-holder .eltdf-pli-inner .eltdf-pli-text-inner .eltdf-pli-add-to-cart.eltdf-light-skin .button:hover',
                    '.eltdf-pl-holder .eltdf-pli-inner .eltdf-pli-text-inner .eltdf-pli-add-to-cart.eltdf-dark-skin .added_to_cart:hover',
                    '.eltdf-pl-holder .eltdf-pli-inner .eltdf-pli-text-inner .eltdf-pli-add-to-cart.eltdf-dark-skin .button:hover',
                    '.eltdf-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a',
                    '.eltdf-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a',
                    '.eltdf-single-product-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a',
                );
            }

            $background_color_selector = array_merge($background_color_selector, $woo_background_color_selector);

            $border_color_selector = array(
                '.eltdf-st-loader .pulse_circles .ball',
                '#submit_comment:hover',
                '.post-password-form input[type=submit]:hover',
                'input.wpcf7-form-control.wpcf7-submit:hover',
                '.eltdf-owl-slider+.eltdf-slider-thumbnail>.eltdf-slider-thumbnail-item.active img',
                '#eltdf-back-to-top>span:not(.eltdf-btn-line)',
            );

            echo roslyn_elated_dynamic_css($color_selector, array('color' => $first_main_color));
	        echo roslyn_elated_dynamic_css($color_important_selector, array('color' => $first_main_color.'!important'));
	        echo roslyn_elated_dynamic_css($background_color_selector, array('background-color' => $first_main_color));
	        echo roslyn_elated_dynamic_css($border_color_selector, array('border-color' => $first_main_color));
        }
	
	    $page_background_color = roslyn_elated_options()->getOptionValue( 'page_background_color' );
	    if ( ! empty( $page_background_color ) ) {
		    $background_color_selector = array(
			    'body',
			    '.eltdf-content'
		    );
		    echo roslyn_elated_dynamic_css( $background_color_selector, array( 'background-color' => $page_background_color ) );
	    }
	
	    $page_background_image  = roslyn_elated_options()->getOptionValue( 'page_background_image' );
	    $page_background_repeat = roslyn_elated_options()->getOptionValue( 'page_background_image_repeat' );
	
	    if ( ! empty( $page_background_image ) ) {
		
		    if ( $page_background_repeat === 'yes' ) {
			    $background_image_style = array(
				    'background-image'    => 'url(' . esc_url( $page_background_image ) . ')',
				    'background-repeat'   => 'repeat',
				    'background-position' => '0 0',
			    );
		    } else {
			    $background_image_style = array(
				    'background-image'    => 'url(' . esc_url( $page_background_image ) . ')',
				    'background-repeat'   => 'no-repeat',
				    'background-position' => 'center 0',
				    'background-size'     => 'cover'
			    );
		    }
		
		    echo roslyn_elated_dynamic_css( '.eltdf-content', $background_image_style );
	    }
	
	    $selection_color = roslyn_elated_options()->getOptionValue( 'selection_color' );
	    if ( ! empty( $selection_color ) ) {
		    echo roslyn_elated_dynamic_css( '::selection', array( 'background' => $selection_color ) );
		    echo roslyn_elated_dynamic_css( '::-moz-selection', array( 'background' => $selection_color ) );
	    }
	
	    $preload_background_styles = array();
	
	    if ( roslyn_elated_options()->getOptionValue( 'preload_pattern_image' ) !== "" ) {
		    $preload_background_styles['background-image'] = 'url(' . roslyn_elated_options()->getOptionValue( 'preload_pattern_image' ) . ') !important';
	    }
	
	    echo roslyn_elated_dynamic_css( '.eltdf-preload-background', $preload_background_styles );
    }

    add_action('roslyn_elated_style_dynamic', 'roslyn_elated_design_styles');
}

if ( ! function_exists( 'roslyn_elated_content_styles' ) ) {
	function roslyn_elated_content_styles() {
		$content_style = array();
		
		$padding = roslyn_elated_options()->getOptionValue( 'content_padding' );
		if ( $padding !== '' ) {
			$content_style['padding'] = $padding;
		}
		
		$content_selector = array(
			'.eltdf-content .eltdf-content-inner > .eltdf-full-width > .eltdf-full-width-inner',
		);
		
		echo roslyn_elated_dynamic_css( $content_selector, $content_style );
		
		$content_style_in_grid = array();
		
		$padding_in_grid = roslyn_elated_options()->getOptionValue( 'content_padding_in_grid' );
		if ( $padding_in_grid !== '' ) {
			$content_style_in_grid['padding'] = $padding_in_grid;
		}
		
		$content_selector_in_grid = array(
			'.eltdf-content .eltdf-content-inner > .eltdf-container > .eltdf-container-inner',
		);
		
		echo roslyn_elated_dynamic_css( $content_selector_in_grid, $content_style_in_grid );
	}
	
	add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_content_styles' );
}

if ( ! function_exists( 'roslyn_elated_h1_styles' ) ) {
	function roslyn_elated_h1_styles() {
		$margin_top    = roslyn_elated_options()->getOptionValue( 'h1_margin_top' );
		$margin_bottom = roslyn_elated_options()->getOptionValue( 'h1_margin_bottom' );
		
		$item_styles = roslyn_elated_get_typography_styles( 'h1' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = roslyn_elated_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = roslyn_elated_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h1'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo roslyn_elated_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_h1_styles' );
}

if ( ! function_exists( 'roslyn_elated_h2_styles' ) ) {
	function roslyn_elated_h2_styles() {
		$margin_top    = roslyn_elated_options()->getOptionValue( 'h2_margin_top' );
		$margin_bottom = roslyn_elated_options()->getOptionValue( 'h2_margin_bottom' );
		
		$item_styles = roslyn_elated_get_typography_styles( 'h2' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = roslyn_elated_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = roslyn_elated_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h2'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo roslyn_elated_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_h2_styles' );
}

if ( ! function_exists( 'roslyn_elated_h3_styles' ) ) {
	function roslyn_elated_h3_styles() {
		$margin_top    = roslyn_elated_options()->getOptionValue( 'h3_margin_top' );
		$margin_bottom = roslyn_elated_options()->getOptionValue( 'h3_margin_bottom' );
		
		$item_styles = roslyn_elated_get_typography_styles( 'h3' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = roslyn_elated_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = roslyn_elated_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h3'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo roslyn_elated_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_h3_styles' );
}

if ( ! function_exists( 'roslyn_elated_h4_styles' ) ) {
	function roslyn_elated_h4_styles() {
		$margin_top    = roslyn_elated_options()->getOptionValue( 'h4_margin_top' );
		$margin_bottom = roslyn_elated_options()->getOptionValue( 'h4_margin_bottom' );
		
		$item_styles = roslyn_elated_get_typography_styles( 'h4' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = roslyn_elated_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = roslyn_elated_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h4'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo roslyn_elated_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_h4_styles' );
}

if ( ! function_exists( 'roslyn_elated_h5_styles' ) ) {
	function roslyn_elated_h5_styles() {
		$margin_top    = roslyn_elated_options()->getOptionValue( 'h5_margin_top' );
		$margin_bottom = roslyn_elated_options()->getOptionValue( 'h5_margin_bottom' );
		
		$item_styles = roslyn_elated_get_typography_styles( 'h5' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = roslyn_elated_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = roslyn_elated_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h5'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo roslyn_elated_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_h5_styles' );
}

if ( ! function_exists( 'roslyn_elated_h6_styles' ) ) {
	function roslyn_elated_h6_styles() {
		$margin_top    = roslyn_elated_options()->getOptionValue( 'h6_margin_top' );
		$margin_bottom = roslyn_elated_options()->getOptionValue( 'h6_margin_bottom' );
		
		$item_styles = roslyn_elated_get_typography_styles( 'h6' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = roslyn_elated_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = roslyn_elated_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h6'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo roslyn_elated_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_h6_styles' );
}

if ( ! function_exists( 'roslyn_elated_text_styles' ) ) {
	function roslyn_elated_text_styles() {
		$item_styles = roslyn_elated_get_typography_styles( 'text' );
		
		$item_selector = array(
			'p'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo roslyn_elated_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_text_styles' );
}

if ( ! function_exists( 'roslyn_elated_link_styles' ) ) {
	function roslyn_elated_link_styles() {
		$link_styles      = array();
		$link_color       = roslyn_elated_options()->getOptionValue( 'link_color' );
		$link_font_style  = roslyn_elated_options()->getOptionValue( 'link_fontstyle' );
		$link_font_weight = roslyn_elated_options()->getOptionValue( 'link_fontweight' );
		$link_decoration  = roslyn_elated_options()->getOptionValue( 'link_fontdecoration' );
		
		if ( ! empty( $link_color ) ) {
			$link_styles['color'] = $link_color;
		}
		if ( ! empty( $link_font_style ) ) {
			$link_styles['font-style'] = $link_font_style;
		}
		if ( ! empty( $link_font_weight ) ) {
			$link_styles['font-weight'] = $link_font_weight;
		}
		if ( ! empty( $link_decoration ) ) {
			$link_styles['text-decoration'] = $link_decoration;
		}
		
		$link_selector = array(
			'a',
			'p a'
		);
		
		if ( ! empty( $link_styles ) ) {
			echo roslyn_elated_dynamic_css( $link_selector, $link_styles );
		}
	}
	
	add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_link_styles' );
}

if ( ! function_exists( 'roslyn_elated_link_hover_styles' ) ) {
	function roslyn_elated_link_hover_styles() {
		$link_hover_styles     = array();
		$link_hover_color      = roslyn_elated_options()->getOptionValue( 'link_hovercolor' );
		$link_hover_decoration = roslyn_elated_options()->getOptionValue( 'link_hover_fontdecoration' );
		
		if ( ! empty( $link_hover_color ) ) {
			$link_hover_styles['color'] = $link_hover_color;
		}
		if ( ! empty( $link_hover_decoration ) ) {
			$link_hover_styles['text-decoration'] = $link_hover_decoration;
		}
		
		$link_hover_selector = array(
			'a:hover',
			'p a:hover'
		);
		
		if ( ! empty( $link_hover_styles ) ) {
			echo roslyn_elated_dynamic_css( $link_hover_selector, $link_hover_styles );
		}
		
		$link_heading_hover_styles = array();
		
		if ( ! empty( $link_hover_color ) ) {
			$link_heading_hover_styles['color'] = $link_hover_color;
		}
		
		$link_heading_hover_selector = array(
			'h1 a:hover',
			'h2 a:hover',
			'h3 a:hover',
			'h4 a:hover',
			'h5 a:hover',
			'h6 a:hover'
		);
		
		if ( ! empty( $link_heading_hover_styles ) ) {
			echo roslyn_elated_dynamic_css( $link_heading_hover_selector, $link_heading_hover_styles );
		}
	}
	
	add_action( 'roslyn_elated_style_dynamic', 'roslyn_elated_link_hover_styles' );
}

if ( ! function_exists( 'roslyn_elated_smooth_page_transition_styles' ) ) {
	function roslyn_elated_smooth_page_transition_styles( $style ) {
		$id            = roslyn_elated_get_page_id();
		$loader_style  = array();
		$current_style = '';
		
		$background_color = roslyn_elated_get_meta_field_intersect( 'smooth_pt_bgnd_color', $id );
		if ( ! empty( $background_color ) ) {
			$loader_style['background-color'] = $background_color;
		}
		
		$loader_selector = array(
			'.eltdf-smooth-transition-loader'
		);
		
		if ( ! empty( $loader_style ) ) {
			$current_style .= roslyn_elated_dynamic_css( $loader_selector, $loader_style );
		}
		
		$spinner_style = array();
        $spinner_style_color = array();

		$spinner_color = roslyn_elated_get_meta_field_intersect( 'smooth_pt_spinner_color', $id );
		if ( ! empty( $spinner_color ) ) {
			$spinner_style['background-color'] = $spinner_color;
			$spinner_style_color['color'] = $spinner_color;
		}
		
		$spinner_selectors = array(
			'.eltdf-st-loader .eltdf-rotate-circles > div',
			'.eltdf-st-loader .pulse',
			'.eltdf-st-loader .double_pulse .double-bounce1',
			'.eltdf-st-loader .double_pulse .double-bounce2',
			'.eltdf-st-loader .cube',
			'.eltdf-st-loader .rotating_cubes .cube1',
			'.eltdf-st-loader .rotating_cubes .cube2',
			'.eltdf-st-loader .stripes > div',
			'.eltdf-st-loader .wave > div',
			'.eltdf-st-loader .two_rotating_circles .dot1',
			'.eltdf-st-loader .two_rotating_circles .dot2',
			'.eltdf-st-loader .five_rotating_circles .container1 > div',
			'.eltdf-st-loader .five_rotating_circles .container2 > div',
			'.eltdf-st-loader .five_rotating_circles .container3 > div',
			'.eltdf-st-loader .atom .ball-1:before',
			'.eltdf-st-loader .atom .ball-2:before',
			'.eltdf-st-loader .atom .ball-3:before',
			'.eltdf-st-loader .atom .ball-4:before',
			'.eltdf-st-loader .clock .ball:before',
			'.eltdf-st-loader .mitosis .ball',
			'.eltdf-st-loader .lines .line1',
			'.eltdf-st-loader .lines .line2',
			'.eltdf-st-loader .lines .line3',
			'.eltdf-st-loader .lines .line4',
			'.eltdf-st-loader .fussion .ball',
			'.eltdf-st-loader .fussion .ball-1',
			'.eltdf-st-loader .fussion .ball-2',
			'.eltdf-st-loader .fussion .ball-3',
			'.eltdf-st-loader .fussion .ball-4',
			'.eltdf-st-loader .wave_circles .ball',
			'.eltdf-st-loader .pulse_circles .ball'
		);

		$spinner_color_selector =  array(
			'.eltdf-st-loader .eltdf-rotate-line:before',
		);
		
		if ( ! empty( $spinner_style ) ) {
			$current_style .= roslyn_elated_dynamic_css( $spinner_selectors, $spinner_style );
		}

		if ( ! empty( $spinner_color_selector ) ) {
			$current_style .= roslyn_elated_dynamic_css( $spinner_color_selector, $spinner_style_color );
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'roslyn_elated_add_page_custom_style', 'roslyn_elated_smooth_page_transition_styles' );
}