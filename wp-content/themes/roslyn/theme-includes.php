<?php

//define constants
define( 'ELATED_ROOT', get_template_directory_uri() );
define( 'ELATED_ROOT_DIR', get_template_directory() );
define( 'ELATED_ASSETS_ROOT', get_template_directory_uri() . '/assets' );
define( 'ELATED_ASSETS_ROOT_DIR', get_template_directory() . '/assets' );
define( 'ELATED_FRAMEWORK_ROOT', get_template_directory_uri() . '/framework' );
define( 'ELATED_FRAMEWORK_ROOT_DIR', get_template_directory() . '/framework' );
define( 'ELATED_FRAMEWORK_ADMIN_ASSETS_ROOT', get_template_directory_uri() . '/framework/admin/assets' );
define( 'ELATED_FRAMEWORK_ICONS_ROOT', get_template_directory_uri() . '/framework/lib/icons-pack' );
define( 'ELATED_FRAMEWORK_ICONS_ROOT_DIR', get_template_directory() . '/framework/lib/icons-pack' );
define( 'ELATED_FRAMEWORK_MODULES_ROOT', get_template_directory_uri() . '/framework/modules' );
define( 'ELATED_FRAMEWORK_MODULES_ROOT_DIR', get_template_directory() . '/framework/modules' );
define( 'ELATED_FRAMEWORK_HEADER_ROOT', get_template_directory_uri() . '/framework/modules/header' );
define( 'ELATED_FRAMEWORK_HEADER_ROOT_DIR', get_template_directory() . '/framework/modules/header' );
define( 'ELATED_FRAMEWORK_HEADER_TYPES_ROOT', ELATED_FRAMEWORK_HEADER_ROOT . '/types' );
define( 'ELATED_FRAMEWORK_HEADER_TYPES_ROOT_DIR', ELATED_FRAMEWORK_HEADER_ROOT_DIR . '/types' );
define( 'ELATED_FRAMEWORK_SEARCH_ROOT', get_template_directory_uri() . '/framework/modules/search' );
define( 'ELATED_FRAMEWORK_SEARCH_ROOT_DIR', get_template_directory() . '/framework/modules/search' );
define( 'ELATED_THEME_ENV', 'false' );
define( 'ELATED_PROFILE_SLUG', 'elated' );
define( 'ELATED_OPTIONS_SLUG', 'roslyn_elated_theme_menu');

//include necessary files
include_once ELATED_ROOT_DIR . '/framework/eltdf-framework.php';
include_once ELATED_ROOT_DIR . '/includes/nav-menu/eltdf-menu.php';
require_once ELATED_ROOT_DIR . '/includes/plugins/class-tgm-plugin-activation.php';
include_once ELATED_ROOT_DIR . '/includes/plugins/plugins-activation.php';
include_once ELATED_ROOT_DIR . '/assets/custom-styles/general-custom-styles.php';
include_once ELATED_ROOT_DIR . '/assets/custom-styles/general-custom-styles-responsive.php';

if ( file_exists( ELATED_ROOT_DIR . '/export' ) ) {
	include_once ELATED_ROOT_DIR . '/export/export.php';
}

if ( ! is_admin() ) {
	include_once ELATED_ROOT_DIR . '/includes/eltdf-body-class-functions.php';
	include_once ELATED_ROOT_DIR . '/includes/eltdf-loading-spinners.php';
}