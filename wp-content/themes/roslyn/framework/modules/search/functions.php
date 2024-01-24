<?php

if ( ! function_exists( 'roslyn_elated_include_search_types_before_load' ) ) {
    /**
     * Load's all header types before load files by going through all folders that are placed directly in header types folder.
     * Functions from this files before-load are used to set all hooks and variables before global options map are init
     */
    function roslyn_elated_include_search_types_before_load() {
        foreach ( glob( ELATED_FRAMEWORK_SEARCH_ROOT_DIR . '/types/*/before-load.php' ) as $module_load ) {
            include_once $module_load;
        }
    }

    add_action( 'roslyn_elated_options_map', 'roslyn_elated_include_search_types_before_load', 1 ); // 1 is set to just be before header option map init
}

if ( ! function_exists( 'roslyn_elated_load_search' ) ) {
	function roslyn_elated_load_search() {
		$search_type_meta = roslyn_elated_options()->getOptionValue( 'search_type' );
		$search_type      = ! empty( $search_type_meta ) ? $search_type_meta : 'fullscreen';
		
		if ( roslyn_elated_active_widget( false, false, 'eltdf_search_opener' ) ) {
			include_once ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/search/types/' . $search_type . '/' . $search_type . '.php';
		}
	}
	
	add_action( 'init', 'roslyn_elated_load_search' );
}

if ( ! function_exists( 'roslyn_elated_get_holder_params_search' ) ) {
	/**
	 * Function which return holder class and holder inner class for blog pages
	 */
	function roslyn_elated_get_holder_params_search() {
		$params_list = array();
		
		$layout = roslyn_elated_options()->getOptionValue( 'search_page_layout' );
		if ( $layout == 'in-grid' ) {
			$params_list['holder'] = 'eltdf-container';
			$params_list['inner']  = 'eltdf-container-inner clearfix';
		} else {
			$params_list['holder'] = 'eltdf-full-width';
			$params_list['inner']  = 'eltdf-full-width-inner';
		}
		
		/**
		 * Available parameters for holder params
		 * -holder
		 * -inner
		 */
		return apply_filters( 'roslyn_elated_search_holder_params', $params_list );
	}
}

if ( ! function_exists( 'roslyn_elated_get_search_page' ) ) {
	function roslyn_elated_get_search_page() {
		$sidebar_layout = roslyn_elated_sidebar_layout();
		
		$params = array(
			'sidebar_layout' => $sidebar_layout
		);
		
		roslyn_elated_get_module_template_part( 'templates/holder', 'search', '', $params );
	}
}

if ( ! function_exists( 'roslyn_elated_get_search_page_layout' ) ) {
	/**
	 * Function which create query for blog lists
	 */
	function roslyn_elated_get_search_page_layout() {
		global $wp_query;
		$path   = apply_filters( 'roslyn_elated_search_page_path', 'templates/page' );
		$type   = apply_filters( 'roslyn_elated_search_page_layout', 'default' );
		$module = apply_filters( 'roslyn_elated_search_page_module', 'search' );
		$plugin = apply_filters( 'roslyn_elated_search_page_plugin_override', false );
		
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		
		$params = array(
			'type'          => $type,
			'query'         => $wp_query,
			'paged'         => $paged,
			'max_num_pages' => roslyn_elated_get_max_number_of_pages(),
		);
		
		$params = apply_filters( 'roslyn_elated_search_page_params', $params );
		
		roslyn_elated_get_module_template_part( $path . '/' . $type, $module, '', $params, $plugin );
	}
}

if ( ! function_exists( 'roslyn_elated_get_search_submit_icon_class' ) ) {
	/**
	 * Loads search submit icon class
	 */
	function roslyn_elated_get_search_submit_icon_class() {

		$search_icon_source	= roslyn_elated_options()->getOptionValue( 'search_icon_source' );

		$search_close_icon_class_array = array(
			'eltdf-search-submit'
		);

		$search_close_icon_class_array[] = $search_icon_source == 'icon_pack' ? 'eltdf-search-submit-icon-pack' : 'eltdf-search-submit-svg-path';

		return $search_close_icon_class_array;
	}
}

if ( ! function_exists( 'roslyn_elated_get_search_close_icon_class' ) ) {
	/**
	 * Loads search close icon class
	 */
	function roslyn_elated_get_search_close_icon_class() {

		$search_icon_source	= roslyn_elated_options()->getOptionValue( 'search_icon_source' );

		$search_close_icon_class_array = array(
			'eltdf-search-close'
		);

		$search_close_icon_class_array[] = $search_icon_source == 'icon_pack' ? 'eltdf-search-close-icon-pack' : 'eltdf-search-close-svg-path';

		return $search_close_icon_class_array;
	}
}

if ( ! function_exists( 'roslyn_elated_get_search_icon_html' ) ) {
	/**
	 * Loads search close icon HTML
	 */
	function roslyn_elated_get_search_icon_html() {

		$search_icon_source 			= roslyn_elated_options()->getOptionValue( 'search_icon_source' );
		$search_icon_pack 				= roslyn_elated_options()->getOptionValue( 'search_icon_pack' );
		$search_icon_svg_path 			= roslyn_elated_options()->getOptionValue( 'search_icon_svg_path' );

		$search_icon_html = '';

		if ( ( $search_icon_source == 'icon_pack' ) && isset( $search_icon_pack ) ) {
			$search_icon_html .= roslyn_elated_icon_collections()->getSearchIcon( $search_icon_pack, false );
		} else if ( isset( $search_icon_svg_path ) ) {
			$search_icon_html .= $search_icon_svg_path; 
		}

		return $search_icon_html;
	}
}

if ( ! function_exists( 'roslyn_elated_get_search_close_icon_html' ) ) {
	/**
	 * Loads search close icon HTML
	 */
	function roslyn_elated_get_search_close_icon_html() {

		$search_icon_source 			= roslyn_elated_options()->getOptionValue( 'search_icon_source' );
		$search_icon_pack 				= roslyn_elated_options()->getOptionValue( 'search_icon_pack' );
		$search_close_icon_svg_path 	= roslyn_elated_options()->getOptionValue( 'search_close_icon_svg_path' );

		$search_close_icon_html = '';

		if ( ( $search_icon_source == 'icon_pack' ) && isset( $search_icon_pack ) ) {
			$search_close_icon_html .= roslyn_elated_icon_collections()->getSearchClose( $search_icon_pack, false );
		} else if ( isset( $search_close_icon_svg_path ) ) {
			$search_close_icon_html .= $search_close_icon_svg_path; 
		}

		return $search_close_icon_html;
	}
}

/* search widget changes */
if ( ! function_exists( 'roslyn_elated_override_search_block_templates' ) ) {
    /**
     * Function that override `core/search` block template
     *
     * @see register_block_core_search()
     */
    function roslyn_elated_override_search_block_templates( $atts ) {
        if ( ! empty( $atts ) && isset( $atts['render_callback'] ) && 'render_block_core_search' === $atts['render_callback'] && function_exists( 'styles_for_block_core_search' ) ) {
            $atts['render_callback'] = 'roslyn_elated_render_block_core_search';
        }
        return $atts;
    }
    add_filter( 'block_type_metadata_settings', 'roslyn_elated_override_search_block_templates' );
}

if ( ! function_exists( 'roslyn_elated_render_block_core_search' ) ) {
    /**
     * Function that dynamically renders the `core/search` block
     *
     * @param array $attributes - the block attributes
     *
     * @return string - the search block markup
     *
     * @see render_block_core_search()
     */
    function roslyn_elated_render_block_core_search( $attributes ) {
        static $instance_id = 0;
        $attributes = wp_parse_args(
            $attributes,
            array(
                'label'      => esc_html__( 'Search', 'roslyn' ),
                'buttonText' => esc_html__( 'Search', 'roslyn' ),
            )
        );
        $input_id        = 'eltdf-search-form-' . ++ $instance_id;
        $classnames      = classnames_for_block_core_search( $attributes );
        $show_label      = ! empty( $attributes['showLabel'] );
        $use_icon_button = ! empty( $attributes['buttonUseIcon'] );
        $show_input      = ! ( ( ! empty( $attributes['buttonPosition'] ) && 'button-only' === $attributes['buttonPosition'] ) );
        $show_button     = ! ( ( ! empty( $attributes['buttonPosition'] ) && 'no-button' === $attributes['buttonPosition'] ) );
        $input_markup    = '';
        $button_markup   = '';
        $inline_styles   = styles_for_block_core_search( $attributes );
        // function get_color_classes_for_block_core_search doesn't exist in wp 5.8 and below
        $color_classes    = function_exists( 'get_color_classes_for_block_core_search' ) ? get_color_classes_for_block_core_search( $attributes ) : '';
        $is_button_inside = ! empty( $attributes['buttonPosition'] ) && 'button-inside' === $attributes['buttonPosition'];
        // border color classes need to be applied to the elements that have a border color
        // function get_border_color_classes_for_block_core_search doesn't exist in wp 5.8 and below
        $border_color_classes = function_exists( 'get_border_color_classes_for_block_core_search' ) ? get_border_color_classes_for_block_core_search( $attributes ) : '';
        $label_markup = sprintf(
            '<label for="%1$s" class="eltdf-search-form-label screen-reader-text">%2$s</label>',
            $input_id,
            empty( $attributes['label'] ) ? esc_html__( 'Search', 'roslyn' ) : esc_html( $attributes['label'] )
        );
        if ( $show_label && ! empty( $attributes['label'] ) ) {
            $label_markup = sprintf(
                '<label for="%1$s" class="eltdf-search-form-label">%2$s</label>',
                $input_id,
                esc_html( $attributes['label'] )
            );
        }
        if ( $show_input ) {
            $input_classes = ! $is_button_inside ? $border_color_classes : '';
            $input_markup  = sprintf(
                '<input type="search" id="%s" class="eltdf-search-form-field %s" name="s" value="%s" placeholder="%s" %s required />',
                $input_id,
                esc_attr( $input_classes ),
                esc_attr( get_search_query() ),
                esc_attr( $attributes['placeholder'] ),
                // key input doesn't exist in wp 5.8 and below
                array_key_exists( 'input', $inline_styles ) ? $inline_styles['input'] : ''
            );
        }
        if ( $show_button ) {
            $button_internal_markup = '';
            $button_classes         = $color_classes;
            $button_classes         .= ! empty( $attributes['buttonPosition'] ) ? ' eltdf--' . $attributes['buttonPosition'] : '';
            if ( ! $is_button_inside ) {
                $button_classes .= ' ' . $border_color_classes;
            }
            if ( ! $use_icon_button ) {
                if ( ! empty( $attributes['buttonText'] ) ) {
                    $button_internal_markup = esc_html( $attributes['buttonText'] );
                }
            } else {
                $button_classes         .= ' eltdf--has-icon';
                //$button_internal_markup = '<svg xmlns="http://www.w3.org/2000/svg" width="32.248" height="32.248" viewBox="0 0 32.248 32.248" fill="currentColor" stroke="currentColor"><path d="M19 0C11.82 0 6 5.82 6 13c0 3.09 1.084 5.926 2.884 8.158L.292 29.75a1.386 1.386 0 0 0 1.958 1.958l8.592-8.592A12.953 12.953 0 0 0 19 26c7.18 0 13-5.82 13-13S26.18 0 19 0zm0 24c-6.066 0-11-4.934-11-11S12.934 2 19 2s11 4.934 11 11-4.934 11-11 11z"/></svg>';
                $button_internal_markup = roslyn_elated_icon_collections()->renderIcon( 'fa fa-search', 'font_awesome' );
            }
            $button_markup = sprintf(
                '<button type="submit" class="eltdf-search-form-button %s" %s>%s</button>',
                esc_attr( $button_classes ),
                // key button doesn't exist in wp 5.8 and below
                array_key_exists( 'button', $inline_styles ) ? $inline_styles['button'] : '',
                $button_internal_markup
            );
        }
        $field_markup_classes = $is_button_inside ? $border_color_classes : '';
        $field_markup         = sprintf(
            '<div class="eltdf-search-form-inner %s"%s>%s</div>',
            $field_markup_classes,
            $inline_styles['wrapper'],
            $input_markup . $button_markup
        );
        $classnames           .= ' eltdf-search-form';
        $wrapper_attributes   = get_block_wrapper_attributes( array( 'class' => $classnames ) );
        return sprintf(
            '<form role="search" method="get" %s action="%s">%s</form>',
            $wrapper_attributes,
            esc_url( home_url( '/' ) ),
            $label_markup . $field_markup
        );
    }
}