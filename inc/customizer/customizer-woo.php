<?php
new WPS_Woo_Customize();
class WPS_Woo_Customize {

	function __construct() {

		if ( ! woo_switch() ) {
			return;
		}

		// Output custom CSS to live site
		add_action( 'wp_head', array( $this, 'header_output' ) );
		add_action( 'admin_head', array( $this, 'header_output' ) );

		// Enqueue live preview javascript in Theme Customizer admin screen
		add_action( 'customize_preview_init', array( $this, 'live_preview' ) );
	}
	/**
	 * This hooks into 'customize_register' (available as of WP 3.4) and allows
	 * you to add new sections and controls to the Theme Customize screen.
	 *
	 * Note: To enable instant preview, we have to actually write a bit of custom
	 * javascript. See live_preview() for more.
	 *
	 * @see add_action('customize_register',$func)
	 * @param \WP_Customize_Manager $wp_customize
	 * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since WPS-LV-426 1.0.0
	 */


	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 *
	 * Used by hook: 'wp_head'
	 *
	 * @see add_action('wp_head',$func)
	 * @since WPS-LV-426 1.0.0
	 */
	public static function customizer_style() {

		$style_list = '';

		$settings = array(
			'--woo-head-utility-symbol-color'       => 'wps_woo_header_utility_icons_color',
			'--woo-head-cart-count-text-color'      => 'wps_woo_header_utility_count_color',
			'--woo-head-cart-count-background'      => 'wps_woo_header_utility_count_background',
			'--woo-head-utility-text-color'         => 'wps_woo_header_utility_color',
			'--woo-head-utility-text-color-light'   => 'wps_woo_header_utility_color_light',
			'--woo-head-utility-background'         => 'wps_woo_header_utility_background',
			'--woo-head-utility-background-h'       => 'wps_woo_header_utility_background_hover',
			'--woo-head-utility-background-dark'    => 'wps_woo_header_utility_background_dark',
			'--woo-color-primary'                   => 'wps_woo_color_primary',
			'--woo-color-highlight'                 => 'wps_woo_color_highlight',
			'--woo-color-on-sale-background'        => 'wps_woo_background_on_sale',
			'--woo-color-on-sale-color'             => 'wps_woo_color_on_sale',
			'--woo-color-out-of-stock'              => 'wps_woo_color_out_of_stock',
			'--woo-color-price'                     => 'wps_woo_color_price',
			'--woo-background-payment-checkout'     => 'wps_woo_background_payment',
			'--woo-payment-box-background'          => 'wps_woo_background_payment_box',
			'--woo-star-rating-color'               => 'wps_woo_star_rating_color',
			'--woo-message-bar-color'               => 'wps_woo_message_bar_color',
			'--woo-message-bar-background'          => 'wps_woo_message_bar_background',
			'--woo-message-bar-theme-default-color' => 'wps_woo_message_bar_theme_default_color',
			'--woo-message-bar-theme-info-color'    => 'wps_woo_message_bar_theme_info_color',
			'--woo-message-bar-theme-error-color'   => 'wps_woo_message_bar_theme_error_color',
		);

		foreach ( $settings as $var => $option ) {
			$style_list .= self::generate_css_var( $var, $option );
		}

		$style = sprintf( ':root {%s}', $style_list );

		return $style;
	}
	public static function header_output() {
		$output  = '<!--Child Woo Customizer CSS-->';
		$output .= '<style type="text/css">';
		$output .= self::customizer_style();
		$output .= '</style>';
		$output .= '<!--/child Woo Customizer CSS-->';
		echo $output;
	}

	/**
	 * This outputs the javascript needed to automate the live settings preview.
	 * Also keep in mind that this function isn't necessary unless your settings
	 * are using 'transport'=>'postMessage' instead of the default 'transport'
	 * => 'refresh'
	 *
	 * Used by hook: 'customize_preview_init'
	 *
	 * @see add_action('customize_preview_init',$func)
	 * @since WPS-LV-426 1.0.0
	 */
	public static function live_preview() {
		wp_enqueue_script(
			'wps-child-woothemecustomizer', // Give the script a unique ID
			get_theme_directory_uri() . '/assets/dist/js/min/child-woo-customizer.min.js', // Define the path to the JS file
			array( 'jquery', 'customize-preview' ), // Define dependencies
			'', // Define a version (optional)
			true // Specify whether to put in footer (leave this true)
		);
	}

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @uses get_theme_mod()
	 * @param string $selector CSS selector
	 * @param string $style The name of the CSS *property* to modify
	 * @param string $mod_name The name of the 'theme_mod' option to fetch
	 * @param string $prefix Optional. Anything that needs to be output before the CSS property
	 * @param string $postfix Optional. Anything that needs to be output after the CSS property
	 * @param bool   $echo Optional. Whether to print directly to the page (default: true).
	 * @return string Returns a single line of CSS with selectors and a property.
	 * @since WPS-LV-426 1.0.0
	 */

	public static function generate_css_var( $var_name, $mod_name, $echo = false ) {
		$return = '';
		$mod    = get_theme_mod( $mod_name );
		if ( ! empty( $mod ) ) {
			$return = sprintf(
				'%s:%s;',
				$var_name,
				$mod
			);
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
	}

}
