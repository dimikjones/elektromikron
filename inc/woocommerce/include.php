<?php

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'elektromikron_product_single_additional_info_content' ) ) {
	/**
	 * Function that adds additional information content after product summary
	 */
	function elektromikron_product_single_additional_info_content() {

		if ( qi_is_installed( 'woocommerce' ) ) {

			echo woocommerce_product_additional_information_tab(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	add_action( 'woocommerce_product_meta_end', 'elektromikron_product_single_additional_info_content', 20 );
}

if ( ! function_exists( 'elektromikron_woocommerce_product_attributes_add_line_break' ) ) {
	/**
	 * Function that change additional information attribute , to <br> tag
	 */
	function elektromikron_woocommerce_product_attributes_add_line_break( $attribute_list, $attribute, $values ) {
		// Only on product page.
		if ( ! is_product() ) return;
		$attribute_list = wpautop( wptexturize( implode( '<br>', $values ) ) );
		return $attribute_list;
	}

	add_filter( 'woocommerce_attribute', 'elektromikron_woocommerce_product_attributes_add_line_break', 10, 3 );
}

if ( ! function_exists( 'elektromikron_qi_addons_for_elementor_product_list_info_below_sku' ) ) {
	/**
	 * Function that adds sku for qi-addons-for-elementor Product List Info Below Variation
	 */
	function elektromikron_qi_addons_for_elementor_product_list_info_below_sku() {

		if ( class_exists( 'QiAddonsForElementor_Product_List_Shortcode' ) ) {

			function add_product_sku() {
				global $product;

				$html = '';
				$sku  = $product->get_sku();

				if ( ! empty( $sku ) ) {
					$html = '<span class="qodef-info-below-sku">' . $sku . '</span>';
				}

				echo wp_kses_post( $html );
			}

			add_filter( 'qi_addons_for_elementor_action_product_list_item_additional_content', 'add_product_sku' );
		}
	}

	add_action( 'init', 'elektromikron_qi_addons_for_elementor_product_list_info_below_sku' );
}

if ( ! function_exists( 'elektromikron_qi_addons_for_elementor_product_list_info_below_excerpt' ) ) {
	/**
	 * Function that adds sku for qi-addons-for-elementor Product List Info Below Variation
	 */
	function elektromikron_qi_addons_for_elementor_product_list_info_below_excerpt() {

		if ( class_exists( 'QiAddonsForElementor_Product_List_Shortcode' ) ) {

			function add_product_excerpt() {
				global $product;

				$html    = '';
				$excerpt = $product->get_short_description();

				if ( ! empty( $excerpt ) ) {
					$html = '<span class="qodef-info-below-excerpt">' . $excerpt . '</span>';
				}

				echo wp_kses_post( $html );
			}

			add_filter( 'qi_addons_for_elementor_action_product_list_item_additional_content', 'add_product_excerpt' );
		}
	}

	add_action( 'init', 'elektromikron_qi_addons_for_elementor_product_list_info_below_excerpt' );
}
