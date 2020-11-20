<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since Child Theme 1.0
 */

add_action( 'customize_register', array( 'WPS_Child_Customize_Woocommerce_Shop', 'register' ) );
class WPS_Child_Customize_Woocommerce_Shop {

	public static function register( $wp_customize ) {

		$wp_customize->add_section(
			'wps_woo_shop_settings',
			array(
				'title'       => __( 'Shop', 'wps-prime' ), // Visible title of section
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( 'WPS Woocommerce options', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'woocommerce',
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_woo_shop_hide_rating',
			array(
				'default'    => false,
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'refresh',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_woo_shop_hide_rating',
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Hide rating on shop product loop', 'wps-prime' ),
				'description' => __( '', 'wps-prime' ),
				'section'     => 'wps_woo_shop_settings',
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_woo_hide_breadcrumb',
			array(
				'default'    => false,
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'refresh',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_woo_hide_breadcrumb',
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Hide breadcrumb', 'wps-prime' ),
				'description' => __( 'Hide woocommerce breadcrumb navigation from shop pages', 'wps-prime' ),
				'section'     => 'wps_woo_shop_settings',
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_woo_single_disable_data_tabs',
			array(
				'default'    => false,
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'refresh',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_woo_single_disable_data_tabs',
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Product data view from tabs to visible sections', 'wps-prime' ),
				'description' => __( 'Single product data: Description / Reviews / Attributes, will all be displayed without tabs.', 'wps-prime' ),
				'section'     => 'wps_woo_shop_settings',
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_woo_shop_layout_switch',
			array(
				'default'    => false,
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'refresh',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_woo_shop_layout_switch',
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Shop sidebar switch to left', 'wps-prime' ),
				'description' => __( 'Sidebar must be active', 'wps-prime' ),
				'section'     => 'wps_woo_shop_settings',
			)
		);

	}
}
