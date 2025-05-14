<?php

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'qi_child_add_header_shortcode_option' ) ) {
	/**
	 * Function that add options for post format
	 *
	 * @param mixed $page - general post format meta box section
	 */
	function qi_child_add_header_shortcode_option( $page ) {

		if ( $page ) {
			$post_format_section = $page->add_section_element(
				array(
					'name'  => 'qodef_em_header_shortcode_section',
					'title' => esc_html__( 'Header Shortcode', 'elektromikron' ),
				)
			);

			$post_format_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_em_header_shortcode',
					'title'       => esc_html__( 'Header Shortcode', 'elektromikron' ),
					'description' => esc_html__( 'Input your shortcode here. It will be displayed after page title', 'elektromikron' ),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qi_child_action_after_header_shortcode_option', $page );
		}
	}

	add_action( 'qode_essential_addons_action_after_general_options_map', 'qi_child_add_header_shortcode_option', 3 );
}

if ( ! function_exists( 'qi_child_add_header_shortcode_meta_box' ) ) {
	/**
	 * Function that add options for post format
	 *
	 * @param mixed $page - general post format meta box section
	 */
	function qi_child_add_header_shortcode_meta_box( $page ) {

		if ( $page ) {
			$post_format_section = $page->add_section_element(
				array(
					'name'  => 'qodef_em_header_shortcode_section',
					'title' => esc_html__( 'Header Shortcode', 'elektromikron' ),
				)
			);

			$post_format_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_em_header_shortcode',
					'title'       => esc_html__( 'Header Shortcode', 'elektromikron' ),
					'description' => esc_html__( 'Input your shortcode here. It will be displayed after page title', 'elektromikron' ),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qi_child_action_after_header_shortcode_meta_box', $page );
		}
	}

	add_action( 'qode_essential_addons_action_after_general_meta_box_map', 'qi_child_add_header_shortcode_meta_box', 3 );
}

if ( ! function_exists( 'elektromikron_load_header_shortcode' ) ) {
	/**
	 * Function which loads header shortcode
	 */
	function elektromikron_load_header_shortcode() {

		$shortcode = qode_essential_addons_get_post_value_through_levels( 'qodef_em_header_shortcode' );

		if ( ! empty( $shortcode ) ) {
			// Include shortcode with html.
			$html  = '<div class="em-header-sc-holder">';
			$html .= do_shortcode( $shortcode );
			$html .= '</div>';

			echo $html;
		}
	}

	add_action( 'qi_action_page_title_template', 'elektromikron_load_header_shortcode', 20 );
}

if ( ! function_exists( 'elektromikron_elementor_scripts' ) ) {

	// If Elementor and WooCommerce plugins are present.
	if ( defined( 'ELEMENTOR_VERSION' ) && class_exists( 'WooCommerce' ) ) {

		function elektromikron_elementor_scripts() {

			// Enqueue only on specific WooCommerce pages.
			if ( is_shop() || is_product() || is_product_category() ) {
				$em_elementor_frontend = new \Elementor\Frontend();
				$em_elementor_frontend->enqueue_scripts();
			}
		}

		add_action( 'wp_enqueue_scripts', 'elektromikron_elementor_scripts', 11 );
	}
}