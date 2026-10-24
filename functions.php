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

		// Enqueue CSS.
		wp_enqueue_style( 'elektromikron-style', get_stylesheet_directory_uri() . '/assets/front.css', array( $main_style ), $theme_version );

		// Enqueue JS.
		wp_enqueue_script(
			'elektromikron-script',
			get_stylesheet_directory_uri() . '/assets/front.js',
			array(),
			$theme_version,
			true
		);
	}

	add_action( 'wp_enqueue_scripts', 'elektromikron_enqueue_scripts' );
}

if ( ! function_exists( 'elektromikron_offload_multiple_stylesheets' ) ) {
	/**
	 * Adds the rel='preload' to stylesheets and onload replace it with rel='stylesheet' in order to offload them.
	 *
	 * @param string $html The complete HTML <link> tag.
	 * @param string $handle The stylesheet's registered handle.
	 *
	 * @return string The modified HTML <link> tag with rel='preload' attribute, or original HTML.
	 */
	function elektromikron_offload_multiple_stylesheets( $html, $handle ) {
		// Define an array of stylesheet handles that you want to offload.
		$offload_handles = array(
			'qode-essential-addons-style',
			'qode-essential-addons-theme-style',
			'qi-grid',
			'qi-main',
			'qi-style',
			'swiper',
			'elementor-icons',
			'elementor-frontend',
			'v4-shims',
			'qi-addons-for-elementor-helper-parts-style',
			'qi-addons-for-elementor-grid-style',
			'qi-addons-for-elementor-style',
			'brands-styles',
		);

		// Check if the current stylesheet's handle is in our list of offload handles.
		if ( in_array( $handle, $offload_handles ) ) {
			// If it is, preload styles
			// return str_replace( "media='stylesheet'", "rel='preload' as='style'" . "onload=\"this.rel='stylesheet'\"", $html ).
			return str_replace( "rel='stylesheet'", "rel=\"preload\" as=\"style\" onload=\"this.rel=&#39;stylesheet&#39;\"", $html );
		}

		// If the handle is not in our list, return the original HTML.
		return $html;
	}

	add_filter( 'style_loader_tag', 'elektromikron_offload_multiple_stylesheets', 10, 2 );
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
