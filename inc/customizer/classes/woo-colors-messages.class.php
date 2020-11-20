<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since Child Theme 1.0
 */

add_action( 'customize_register', array( 'WPS_Child_Customize_Woocommerce_Message_Colors', 'register' ) );
class WPS_Child_Customize_Woocommerce_Message_Colors {

	public static function register( $wp_customize ) {

		$wp_customize->add_section(
			'wps_woo_message_color_settings',
			array(
				'title'       => __( 'Colors - Messages', 'wps-prime' ), // Visible title of section
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( 'Color settings for the message bar', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'woocommerce',
			)
		);

		/**
	   * Message bar
	   */
		// SETTING
		$wp_customize->add_setting(
			'wps_woo_message_bar_background',
			array(
				'default'    => '#e8e8e8',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_woo_message_bar_background',
				array(
					'label'       => __( 'Message bar background color', 'wps-prime' ),
					'description' => __( '', 'wps-prime' ),
					'settings'    => 'wps_woo_message_bar_background',
					'section'     => 'wps_woo_message_color_settings',
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_woo_message_bar_color',
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
				'wps_theme_woo_message_bar_color',
				array(
					'label'       => __( 'Message bar text color', 'wps-prime' ),
					'description' => __( '', 'wps-prime' ),
					'settings'    => 'wps_woo_message_bar_color',
					'section'     => 'wps_woo_message_color_settings',
				)
			)
		);

		// Default message bar accent color
		// SETTING
		$wp_customize->add_setting(
			'wps_woo_message_bar_theme_default_color',
			array(
				'default'    => '#8fae1b',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_woo_bar_theme_default_color',
				array(
					'label'       => __( 'Default message accent color', 'wps-prime' ),
					'description' => __( 'Applied to border and icon', 'wps-prime' ),
					'settings'    => 'wps_woo_message_bar_theme_default_color',
					'section'     => 'wps_woo_message_color_settings',
				)
			)
		);

		// Info message bar accent color
		// SETTING
		$wp_customize->add_setting(
			'wps_woo_message_bar_theme_info_color',
			array(
				'default'    => '#1e85be',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_woo_bar_theme_info_color',
				array(
					'label'       => __( 'Info message bar accent color', 'wps-prime' ),
					'description' => __( 'Applied to border and icon', 'wps-prime' ),
					'settings'    => 'wps_woo_message_bar_theme_info_color',
					'section'     => 'wps_woo_message_color_settings',
				)
			)
		);

		// Info message bar accent color
		// SETTING
		$wp_customize->add_setting(
			'wps_woo_message_bar_theme_error_color',
			array(
				'default'    => '#e74c3c',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_woo_bar_theme_error_color',
				array(
					'label'       => __( 'Error message bar accent color', 'wps-prime' ),
					'description' => __( 'Applied to border and icon', 'wps-prime' ),
					'settings'    => 'wps_woo_message_bar_theme_error_color',
					'section'     => 'wps_woo_message_color_settings',
				)
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'wps_woo_message_bar_theme_default_color',
			array(
				'selector' => '.woocommerce-notices-wrapper .woocommerce-message',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'wps_woo_message_bar_theme_info_color',
			array(
				'selector' => '.woocommerce-info',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'wps_woo_message_bar_theme_error_color',
			array(
				'selector' => '.woocommerce-NoticeGroup  > ul.woocommerce-error',
			)
		);

	}
}
