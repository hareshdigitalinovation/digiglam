<?php

if ( ! function_exists( 'roslyn_core_import_object' ) ) {
	function roslyn_core_import_object() {
		$roslyn_core_import_object = new RoslynCoreImport();
	}
	
	add_action( 'init', 'roslyn_core_import_object' );
}

if ( ! function_exists( 'roslyn_core_data_import' ) ) {
	function roslyn_core_data_import() {
		$importObject = RoslynCoreImport::getInstance();
		
		if ( $_POST['import_attachments'] == 1 ) {
			$importObject->attachments = true;
		} else {
			$importObject->attachments = false;
		}
		
		$folder = "roslyn/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_content( $folder . $_POST['xml'] );
		
		die();
	}
	
	add_action( 'wp_ajax_roslyn_core_data_import', 'roslyn_core_data_import' );
}

if ( ! function_exists( 'roslyn_core_widgets_import' ) ) {
	function roslyn_core_widgets_import() {
		$importObject = RoslynCoreImport::getInstance();
		
		$folder = "roslyn/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_widgets( $folder . 'widgets.txt', $folder . 'custom_sidebars.txt' );
		
		die();
	}
	
	add_action( 'wp_ajax_roslyn_core_widgets_import', 'roslyn_core_widgets_import' );
}

if ( ! function_exists( 'roslyn_core_options_import' ) ) {
	function roslyn_core_options_import() {
		$importObject = RoslynCoreImport::getInstance();
		
		$folder = "roslyn/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_options( $folder . 'options.txt' );
		
		die();
	}
	
	add_action( 'wp_ajax_roslyn_core_options_import', 'roslyn_core_options_import' );
}

if ( ! function_exists( 'roslyn_core_other_import' ) ) {
	function roslyn_core_other_import() {
		$importObject = RoslynCoreImport::getInstance();
		
		$folder = "roslyn/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_options( $folder . 'options.txt' );
		$importObject->import_widgets( $folder . 'widgets.txt', $folder . 'custom_sidebars.txt' );
		$importObject->import_menus( $folder . 'menus.txt' );
		$importObject->import_settings_pages( $folder . 'settingpages.txt' );

		$importObject->eltdf_update_meta_fields_after_import($folder);
		$importObject->eltdf_update_options_after_import($folder);

		if ( roslyn_core_is_revolution_slider_installed() ) {
			$importObject->rev_slider_import( $folder );
		}
		
		die();
	}
	
	add_action( 'wp_ajax_roslyn_core_other_import', 'roslyn_core_other_import' );
}