<?php

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Floating Contact Actions - Options.
if ( ! function_exists( 'qi_child_add_dismissable_info' ) ) {
	/**
	 * Function that add options for post format
	 *
	 * @param object $page
	 * @param array  $general_header_tab
	 */
	function qi_child_add_dismissable_info( $page, $general_header_tab ) {

		$section = $general_header_tab->add_section_element(
			array(
				'name'  => 'qodef_em_dismissable_info',
				'title' => esc_html__( 'Dismissable Info', 'elektromikron' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'yesno',
				'name'          => 'qodef_em_dismissable_info_show',
				'title'         => esc_html__( 'Show Dismissable Info', 'elektromikron' ),
				'description'   => esc_html__( 'Will display dismissable info on top of the page when enabled from content inside Dismisable Info Widget', 'elektromikron' ),
				'default_value' => 'no',
			)
		);

		// Hook to include additional options after module options.
		do_action( 'qi_child_action_after_dismissable_info_option', $page );
	}

	add_action( 'qode_essential_addons_action_after_header_options_map', 'qi_child_add_dismissable_info', 25, 2 );
}

if ( ! function_exists( 'qi_child_register_dismissable_info_sidebar' ) ) {
	/**
	 * Register side area sidebar
	 */
	function qi_child_register_dismissable_info_sidebar() {

		// Sidebar config variables.
		$config = qode_essential_addons_get_side_area_config();

		register_sidebar(
			array(
				'id'            => 'em-dsimisable-content',
				'name'          => esc_html__( 'Dismisable Info', 'elektromikron' ),
				'description'   => esc_html__( 'Widgets added here will appear at the top of the page when Show Dismissable Info option is enabled.', 'elektromikron' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s" data-area="side-area">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . esc_attr( $config['title_tag'] ) . ' class="' . esc_attr( $config['title_class'] ) . '">',
				'after_title'   => '</' . esc_attr( $config['title_tag'] ) . '>',
			)
		);
	}

	add_action( 'widgets_init', 'qi_child_register_dismissable_info_sidebar' );
}

// Load template for Floating Contact Actions.
if ( ! function_exists( 'qi_child_add_floating_contact_actions_load_template' ) ) {
	/**
	 * Loads contact actions HTML
	 */
	function qi_child_add_floating_contact_actions_load_template() {
		$dismisable_info_enabled = 'no' !== qode_essential_addons_get_post_value_through_levels( 'qodef_em_dismissable_info_show' );

		if ( $dismisable_info_enabled && is_active_sidebar( 'em-dsimisable-content' ) ) {

			qode_essential_addons_framework_template_part( ELEKTROMIKRON_INC_PATH, 'dismissable-info', 'templates/dismissable-info', '' );
		}
	}

	// Add it as first after id="qodef-page-wrapper".
	add_action( 'qi_action_page_header_template', 'qi_child_add_floating_contact_actions_load_template', 10 );
}
