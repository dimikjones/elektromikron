<?php

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Elektromikron theme constants.
define( 'ELEKTROMIKRON_INC_PATH', __DIR__ . '/inc' );
define( 'ELEKTROMIKRON_ROOT_DIR', get_stylesheet_directory() );


if ( ! function_exists( 'elektromikron_enqueue_scripts' ) ) {
	/**
	 * Function that enqueue theme's child style - elektromikron style
	 */
	function elektromikron_enqueue_scripts() {
		$theme_version = function_exists( 'wp_get_theme' ) ? wp_get_theme()->get( 'Version' ) : false;
		$main_style    = 'qi-style';

		wp_enqueue_style( 'elektromikron-style', get_stylesheet_directory_uri() . '/assets/front.css', array( $main_style ), $theme_version );
	}

	add_action( 'wp_enqueue_scripts', 'elektromikron_enqueue_scripts' );
}

// Include child theme modules.
if ( ! function_exists( 'elektromikron_include_modules' ) ) {

	function elektromikron_include_modules() {

		foreach ( glob( ELEKTROMIKRON_ROOT_DIR . '/inc/*/include.php' ) as $module ) {
			include_once $module;
		}
	}

	// Call the function for file inclusion.
	elektromikron_include_modules();
}
