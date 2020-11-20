<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since Child Theme 1.0
 */

add_action( 'customize_register', array( 'WPS_Child_Customize_Woocommerce_Single_Product', 'register' ) );

class WPS_Child_Customize_Woocommerce_Single_Product {

	public static function register( $wp_customize ) {
		$wp_customize->add_section(
			'wps_woo_single_settings',
			array(
				'title'       => __( 'Single Product', 'wps-prime' ), // Visible title of section
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( 'Single product page settings', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'woocommerce',
			)
		);

		$wp_customize->add_setting(
			'wps_woo_single_header_start_area', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_woo_single_header_start_area', // Set a unique ID for the control
			array(
				'type'        => 'textarea',
				'label'       => __( 'Single product top content area', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Visible at the start of the single woocommerce product', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'wps_woo_single_settings', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);
	}

}
