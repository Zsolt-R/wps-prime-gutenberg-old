<?php

class WPS_Customizer_Style_runner {

	private static $instance;

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		add_action( 'customize_preview_init', array( $this, 'live_preview' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'customizer_style' ) );

		add_filter( 'admin_head', array( $this, 'admin_output' ) );
	}

	private function generate_styles() {

		$style_list = '';

		$header_bg         = get_theme_mod( 'wps_header_background_sticky', '#000000' );
		$header_bg_opacity = get_theme_mod( 'wps_header_background_sticky_opacity', '0.8' );

		$settings = array(
			// Theme
			'--header-background'                   => 'wps_header_background',
			'--main-nav-background-color'           => 'wps_mega_menu_background',
			'--main-nav-text-color'                 => 'wps_main_nav_text_color',
			'--main-nav-side-text-color'            => 'wps_main_side_nav_text_color',
			'--main-nav-side-background'            => 'wps_main_side_nav_background_color',
			'--main-nav-sticky-text-color'          => 'wps_main_nav_sticky_text_color',
			'--main-nav-text-color-h'               => 'wps_main_nav_text_color_h',
			'--main-nav-text-color-a'               => 'wps_main_nav_text_color_active',
			'--main-nav-submenu-text-color'         => 'wps_main_nav_submenu_text_color',
			'--main-nav-submenu-text-color-h'       => 'wps_main_nav_submenu_text_color_h',
			'--main-nav-submenu-text-color-a'       => 'wps_main_nav_submenu_text_color_active',
			'--main-nav-submenu-background'         => 'wps_main_submenu_background',
			'--main-nav-ca-one-color'               => 'wps_main_nav_ca_one_color',
			'--main-nav-ca-two-color'               => 'wps_main_nav_ca_two_color',
			'--main-nav-ca-text-color'              => 'wps_main_nav_ca_text_color',
			'--head-utility-color'                  => 'wps_main_nav_utility_color',
			'--head-utility-color-h'                => 'wps_main_nav_utility_color_h',
			'--footer-heading-color'                => 'wps_footer_heading_color',
			'--footer-text-color'                   => 'wps_footer_text_color',
			'--footer-link-color'                   => 'wps_footer_link_color',
			'--footer-background-color'             => 'wps_footer_background_color',
			'--footer-micro-background-color'       => 'wps_footer_micro_background_color',

			// Woocommerce
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

		// Custom scenarios
		$style_list .= '--header-background-sticky:' . $this->hex2rgba( $header_bg, $header_bg_opacity ) . ';';
		$style_list .= '--header-background-sticky-h:' . $this->hex2rgba( $header_bg, '1' ) . ';';
		$style_list .= $this->generate_css_var_hex( '--main-nav-ca-one-color-h', 'wps_main_nav_ca_one_color' );
		$style_list .= $this->generate_css_var_hex( '--main-nav-ca-two-color-h', 'wps_main_nav_ca_two_color' );

		$style = sprintf( ':root {%s}', $style_list );

		return $style;
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
	 * @since WPS-PRIME 3.0
	 */
	public function live_preview() {
		wp_enqueue_script(
			'wps-prime-theme-customizer', // Give the script a unique ID
			get_template_directory_uri() . '/assets/dist/js/min/wps-prime-customizer.min.js', // Define the path to the JS file
			array( 'jquery', 'customize-preview' ), // Define dependencies
			WPS_PRIME_THEME_VERSION, // Define a version (optional)
			true // Specify whether to put in footer (leave this true)
		);
	}
	public function customizer_style() {
		wp_add_inline_style( 'wps-prime-style', $this->generate_styles() );
	}

	public function admin_output() {
		$output  = '<!--Theme Customizer CSS-->';
		$output .= '<style type="text/css">';
		$output .= $this->generate_styles();
		$output .= '</style>';
		$output .= '<!--/Theme Customizer CSS-->';
		echo $output;
	}



	private function generate_css_var( $var_name, $mod_name, $echo = false ) {
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

	private function generate_css_var_hex( $var_name, $mod_name, $echo = false, $modifier = '-0.2' ) {
		$return     = '';
		$mod        = get_theme_mod( $mod_name );
		$luminosity = get_theme_mod( 'wps_button_color_hover_modifier', $modifier );

		if ( ! empty( $mod ) ) {
			$return = sprintf(
				'%s:%s;',
				$var_name,
				$this->luminance( $mod, $luminosity )
			);
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
	}

	private function luminance( $hex, $percent ) {
		// validate hex string
		$hex     = preg_replace( '/[^0-9a-f]/i', '', $hex );
		$new_hex = '#';

		if ( strlen( $hex ) < 6 ) {
			$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
		}
		// convert to decimal and change luminosity
		for ( $i = 0; $i < 3; $i++ ) {
			$dec      = hexdec( substr( $hex, $i * 2, 2 ) );
			$dec      = min( max( 0, $dec + $dec * $percent ), 255 );
			$new_hex .= str_pad( dechex( $dec ), 2, 0, STR_PAD_LEFT );
		}
		return $new_hex;
	}

	/**
	 * Convert hexdec color string to rgb(a) string
	 * If we want make opacity, we have to convert hexadecimal into rgb(a), because WordPress customizer give to us hexadecimal colour
	 *
	 * @link https://mekshq.com/how-to-convert-hexadecimal-color-code-to-rgb-or-rgba-using-php/
	 */
	private function hex2rgba( $color, $opacity = false ) {
		$default = 'rgb( 0, 0, 0 )';
		/**
		 * Return default if no color provided
		 */
		if ( empty( $color ) ) {
			return $default;
		}

		/**
		 * Sanitize $color if "#" is provided
		 */
		if ( $color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		/**
		 * Check if color has 6 or 3 characters and get values
		 */
		if ( strlen( $color ) == 6 ) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}

		/**
		 * [$rgb description]
	 *
		 * @var array
		 */
		$rgb = array_map( 'hexdec', $hex );

		/**
		 * Check if opacity is set(rgba or rgb)
		 */

		if ( $opacity !== null ) {
			if ( abs( $opacity ) > 1 ) {
				$opacity = 1.0;
			}
			$output = 'rgba( ' . implode( ',', $rgb ) . ',' . $opacity . ' )';
		} else {
			$output = 'rgb( ' . implode( ',', $rgb ) . ' )';
		}

		/**
		 * Return rgb(a) color string
		 */
		return $output;
	}
}

WPS_Customizer_Style_runner::get_instance();
