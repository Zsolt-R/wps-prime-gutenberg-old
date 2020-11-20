<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since Child Theme 1.0
 */

add_action( 'customize_register', array( 'WPS_Child_Customize_Woocommerce_Colors_Header_utility', 'register' ) );
class WPS_Child_Customize_Woocommerce_Colors_Header_utility {

	public static function register( $wp_customize ) {

		$wp_customize->add_section(
			'wps_woo_color_header_utility_settings',
			array(
				'title'       => __( 'Colors - Header utility', 'wps-prime' ), // Visible title of section
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( 'WPS LV 426 Woocommerce header utility settings', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'woocommerce',
			)
		);

		/**
		 * Header utility icon colors
		 */

		// SETTING
		$wp_customize->add_setting(
			'wps_woo_header_utility_icons_color',
			array(
				'default'    => '#000000',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_woo_header_utility_symbol_color',
				array(
					'label'       => __( 'Utility icon colors', 'wps-prime' ),
					'description' => __( '', 'wps-prime' ),
					'settings'    => 'wps_woo_header_utility_icons_color',
					'section'     => 'wps_woo_color_header_utility_settings',
				)
			)
		);

		/**
		 * Header count colors
		 */
		// SETTING
		$wp_customize->add_setting(
			'wps_woo_header_utility_count_color',
			array(
				'default'    => '#ffffff',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_woo_header_utility_count_text_color',
				array(
					'label'       => __( 'Count icon text color', 'wps-prime' ),
					'description' => __( '', 'wps-prime' ),
					'settings'    => 'wps_woo_header_utility_count_color',
					'section'     => 'wps_woo_color_header_utility_settings',
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_woo_header_utility_count_background',
			array(
				'default'    => '#000000',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_woo_header_utility_count_background_color',
				array(
					'label'       => __( 'Count icon background color', 'wps-prime' ),
					'description' => __( '', 'wps-prime' ),
					'settings'    => 'wps_woo_header_utility_count_background',
					'section'     => 'wps_woo_color_header_utility_settings',
				)
			)
		);
		/**
		 * Header utility text
		 */
		// SETTING
		$wp_customize->add_setting(
			'wps_woo_header_utility_color',
			array(
				'default'    => '#000000',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_woo_header_utility_text_color',
				array(
					'label'       => __( 'Utility text color light', 'wps-prime' ),
					'description' => __( 'Cart and user menu text color', 'wps-prime' ),
					'settings'    => 'wps_woo_header_utility_color',
					'section'     => 'wps_woo_color_header_utility_settings',
				)
			)
		);

		$wp_customize->add_setting(
			'wps_woo_header_utility_color_light',
			array(
				'default'    => '#bbbbbb',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_woo_header_utility_text_color_light',
				array(
					'label'       => __( 'Utility text color', 'wps-prime' ),
					'description' => __( 'Cart light text color', 'wps-prime' ),
					'settings'    => 'wps_woo_header_utility_color_light',
					'section'     => 'wps_woo_color_header_utility_settings',
				)
			)
		);
		/**
				 * Header utility text
				 */
		// SETTING
		$wp_customize->add_setting(
			'wps_woo_header_utility_background',
			array(
				'default'    => '#ffffff',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_woo_header_utility_background_color',
				array(
					'label'       => __( 'Utility background color', 'wps-prime' ),
					'description' => __( 'Cart and user menu background color', 'wps-prime' ),
					'settings'    => 'wps_woo_header_utility_background',
					'section'     => 'wps_woo_color_header_utility_settings',
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_woo_header_utility_background_hover',
			array(
				'default'    => '#e5e5e5',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_woo_header_utility_background_hover_color',
				array(
					'label'       => __( 'Utility background hover color', 'wps-prime' ),
					'description' => __( 'Cart and user menu hover background color', 'wps-prime' ),
					'settings'    => 'wps_woo_header_utility_background_hover',
					'section'     => 'wps_woo_color_header_utility_settings',
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_woo_header_utility_background_dark',
			array(
				'default'    => '#222329',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_woo_header_utility_background_dark_color',
				array(
					'label'       => __( 'Utility background dark color', 'wps-prime' ),
					'description' => __( 'Cart total background color', 'wps-prime' ),
					'settings'    => 'wps_woo_header_utility_background_dark',
					'section'     => 'wps_woo_color_header_utility_settings',
				)
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'wps_woo_header_utility_icons_color',
			array(
				'selector' => '.woo-head-utility-wrapper',
			)
		);

	}
}
