<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since Child Theme 1.0
 */

add_action( 'customize_register', array( 'WPS_Child_Customize_Woocommerce_Checkout_Colors', 'register' ) );
class WPS_Child_Customize_Woocommerce_Checkout_Colors {

	public static function register( $wp_customize ) {

		$wp_customize->add_section(
			'wps_woo_checkout_color_settings',
			array(
				'title'       => __( 'Colors - Checkout', 'wps-prime' ), // Visible title of section
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( 'Color settings for the checkout area', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'woocommerce',
			)
		);

		/**
		 * Checkout payment
		 */
		// SETTING
		$wp_customize->add_setting(
			'wps_woo_background_payment',
			array(
				'default'    => '#f5f5f5',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_woo_background_payment',
				array(
					'label'       => __( 'Payment box background', 'wps-prime' ),
					'description' => __( 'Checkout page payment box background color', 'wps-prime' ),
					'settings'    => 'wps_woo_background_payment',
					'section'     => 'wps_woo_checkout_color_settings',
				)
			)
		);
		// SETTING
		$wp_customize->add_setting(
			'wps_woo_background_payment_box',
			array(
				'default'    => '#313131',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_woo_background_payment_box',
				array(
					'label'       => __( 'Payment box message background', 'wps-prime' ),
					'description' => __( 'Checkout page payment message background color', 'wps-prime' ),
					'settings'    => 'wps_woo_background_payment_box',
					'section'     => 'wps_woo_checkout_color_settings',
				)
			)
		);
		// SETTING
		$wp_customize->add_setting(
			'wps_woo_color_payment_box',
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
				'wps_theme_woo_color_payment_box',
				array(
					'label'       => __( 'Payment box message color', 'wps-prime' ),
					'description' => __( 'Checkout page payment message color', 'wps-prime' ),
					'settings'    => 'wps_woo_color_payment_box',
					'section'     => 'wps_woo_checkout_color_settings',
				)
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'wps_woo_background_payment',
			array(
				'selector' => '#payment.woocommerce-checkout-payment',
			)
		);
	}
}
