<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since Child Theme 1.0
 */

add_action( 'customize_register', array( 'WPS_Child_Customize_Woocommerce_Shop_Colors', 'register' ) );
class WPS_Child_Customize_Woocommerce_Shop_Colors {

	public static function register( $wp_customize ) {

		$wp_customize->add_section(
			'wps_woo_shop_color_settings',
			array(
				'title'       => __( 'Colors - Shop', 'wps-prime' ), // Visible title of section
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( 'Color settings for the shop / cart ', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'woocommerce',
			)
		);

		/**
		* Store notices | Price filter bar
		*/
		// SETTING
		$wp_customize->add_setting(
			'wps_woo_color_primary',
			array(
				'default'    => '#156fbf',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_woo_color_primary',
				array(
					'label'       => __( 'Primary color', 'wps-prime' ),
					'description' => __( 'Used in Messages | Store notices | Price filter bar', 'wps-prime' ),
					'settings'    => 'wps_woo_color_primary',
					'section'     => 'wps_woo_shop_color_settings',
				)
			)
		);

		/**
		* Stock | discount color
		*/
		// SETTING
		$wp_customize->add_setting(
			'wps_woo_color_highlight',
			array(
				'default'    => '#6ec04a',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_woo_color_highlight',
				array(
					'label'       => __( 'Highlight Color', 'wps-prime' ),
					'description' => __( 'Used in Stock | Discount color', 'wps-prime' ),
					'settings'    => 'wps_woo_color_highlight',
					'section'     => 'wps_woo_shop_color_settings',
				)
			)
		);

		/**
		 * On sale
		 */
		// SETTING
		$wp_customize->add_setting(
			'wps_woo_background_on_sale',
			array(
				'default'    => '#5c992e',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_woo_background_on_sale',
				array(
					'label'       => __( 'Sale badge background color', 'wps-prime' ),
					'description' => __( 'Used in sale badge', 'wps-prime' ),
					'settings'    => 'wps_woo_background_on_sale',
					'section'     => 'wps_woo_shop_color_settings',
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_woo_color_on_sale',
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
				'wps_theme_woo_color_on_sale',
				array(
					'label'       => __( 'Sale badge text color', 'wps-prime' ),
					'description' => __( 'Used in sale badge', 'wps-prime' ),
					'settings'    => 'wps_woo_color_on_sale',
					'section'     => 'wps_woo_shop_color_settings',
				)
			)
		);
		/**
		  * Out of stock
		   */
		// SETTING
		$wp_customize->add_setting(
			'wps_woo_color_out_of_stock',
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
				'wps_theme_woo_color_out_of_stock',
				array(
					'label'       => __( 'Out of stock color', 'wps-prime' ),
					'description' => __( 'Used in Out of stock text', 'wps-prime' ),
					'settings'    => 'wps_woo_color_out_of_stock',
					'section'     => 'wps_woo_shop_color_settings',
				)
			)
		);

		/**
	   * Color Price
	   */
		// SETTING
		$wp_customize->add_setting(
			'wps_woo_color_price',
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
				'wps_theme_woo_color_price',
				array(
					'label'       => __( 'Price text color', 'wps-prime' ),
					'description' => __( 'Color of the price text', 'wps-prime' ),
					'settings'    => 'wps_woo_color_price',
					'section'     => 'wps_woo_shop_color_settings',
				)
			)
		);

		/**
		 * Star rating color
		 */
		// SETTING
		$wp_customize->add_setting(
			'wps_woo_star_rating_color',
			array(
				'default'    => '#f9bf3b',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);
		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_woo_star_rating_color',
				array(
					'label'       => __( 'Star rating color', 'wps-prime' ),
					'description' => __( 'Background color of rating stars', 'wps-prime' ),
					'settings'    => 'wps_woo_star_rating_color',
					'section'     => 'wps_woo_shop_color_settings',
				)
			)
		);
	}
}
