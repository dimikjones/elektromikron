<?php

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Floating Contact Actions - Options.
if ( ! function_exists( 'qi_child_add_floating_contact_actions' ) ) {
	/**
	 * Function that add options for post format
	 *
	 * @param mixed $page - general post format meta box section
	 */
	function qi_child_add_floating_contact_actions( $page ) {

		if ( $page ) {

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_em_floating_contact_actions',
					'title'         => esc_html__( 'Floating Contact Actions', 'elektromikron' ),
					'default_value' => 'no',
				)
			);

			$floating_contact_section = $page->add_section_element(
				array(
					'name'       => 'qodef_em_floating_contact_actions_section',
					'title'      => esc_html__( 'Floating Contact Section', 'qode-essential-addons' ),
					'dependency' => array(
						'show' => array(
							'qodef_em_floating_contact_actions' => array(
								'values'        => 'yes',
								'default_value' => 'no',
							),
						),
					),
				)
			);

			$floating_contact_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_em_floating_contact_actions_phone',
					'title'         => esc_html__( 'Phone', 'elektromikron' ),
					'default_value' => 'no',
				)
			);
			$floating_contact_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_em_floating_contact_actions_phone_number',
					'title'       => esc_html__( 'Phone Number', 'elektromikron' ),
					'description' => esc_html__( 'Enter Number in full format with country code (e.g. +381555333)', 'elektromikron' ),
					'dependency'  => array(
						'show' => array(
							'qodef_em_floating_contact_actions_phone' => array(
								'values'        => 'yes',
								'default_value' => 'no',
							),
						),
					),
				)
			);

			$floating_contact_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_em_floating_contact_actions_whatsapp',
					'title'         => esc_html__( 'WhatsApp', 'elektromikron' ),
					'default_value' => 'no',
				)
			);
			$floating_contact_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_em_floating_contact_actions_whatsapp_number',
					'title'       => esc_html__( 'WhatsApp Number', 'elektromikron' ),
					'description' => esc_html__( 'Enter Number in regular format without country code (e.g. 064555333)', 'elektromikron' ),
					'dependency'  => array(
						'show' => array(
							'qodef_em_floating_contact_actions_whatsapp' => array(
								'values'        => 'yes',
								'default_value' => 'no',
							),
						),
					),
				)
			);

			$floating_contact_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_em_floating_contact_actions_viber',
					'title'         => esc_html__( 'Viber', 'elektromikron' ),
					'default_value' => 'no',
				)
			);
			$floating_contact_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_em_floating_contact_actions_viber_number',
					'title'       => esc_html__( 'Viber Number', 'elektromikron' ),
					'description' => esc_html__( 'Enter Number in full format with country code but WITHOUT + (e.g. 381555333)', 'elektromikron' ),
					'dependency'  => array(
						'show' => array(
							'qodef_em_floating_contact_actions_viber' => array(
								'values'        => 'yes',
								'default_value' => 'no',
							),
						),
					),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qi_child_action_after_floating_contact_actions_option', $page );
		}
	}

	add_action( 'qode_essential_addons_action_after_back_to_top_options_map', 'qi_child_add_floating_contact_actions', 3 );
}

// Load template for Floating Contact Actions.
if ( ! function_exists( 'qi_child_add_floating_contact_actions_load_template' ) ) {
	/**
	 * Loads contact actions HTML
	 */
	function qi_child_add_floating_contact_actions_load_template() {
		$contact_enabled  = 'no' !== qode_essential_addons_get_post_value_through_levels( 'qodef_em_floating_contact_actions' );
		$phone_enabled    = 'no' !== qode_essential_addons_get_post_value_through_levels( 'qodef_em_floating_contact_actions_phone' );
		$whatsapp_enabled = 'no' !== qode_essential_addons_get_post_value_through_levels( 'qodef_em_floating_contact_actions_whatsapp' );
		$viber_enabled    = 'no' !== qode_essential_addons_get_post_value_through_levels( 'qodef_em_floating_contact_actions_viber' );

		if ( $contact_enabled ) {

			$params = array(
				'phone_enabled'    => $phone_enabled,
				'whatsapp_enabled' => $whatsapp_enabled,
				'viber_enabled'    => $viber_enabled,
			);

			if ( $phone_enabled || $whatsapp_enabled || $viber_enabled ) {
				qode_essential_addons_framework_template_part( ELEKTROMIKRON_INC_PATH, 'floating-contact', 'templates/floating-contact', '', $params );
			}
		}
	}

	add_action( 'wp_footer', 'qi_child_add_floating_contact_actions_load_template', 10 );
}