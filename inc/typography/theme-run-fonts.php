<?php
/**
 * Register and add theme fonts to header
 *
 * @package wps_prime
 */

/**
 * Function that creates <link> and <style> font definitions to added to theme head
 * Calls the settings from theme options panel and maps with the multidimensional array served by base_typo();
 * Creates inline style for main font
 */

class WPS_Prime_Run_Theme_Fonts {
	public function __construct() {
		add_action( 'wp_head', array( $this, 'google_fonts_preconnect' ), 5 );
		add_action( 'wp_enqueue_scripts', array( $this, 'wps_add_theme_fonts' ), 99 ); // Add last in style chain.
		add_action( 'enqueue_block_editor_assets', array( $this, 'wps_add_theme_fonts' ) );
		add_filter( 'body_class', array( $this, 'wps_filter_handler' ), 10, 4 );
	}

	public function google_fonts_preconnect() {

		if ( get_theme_mod( 'wps_custom_font_family_status' ) ) {
			return;
		}

		echo '<link rel="preconnect" href="https://fonts.gstatic.com">';
	}

	public function wps_add_theme_fonts() {

		if ( get_theme_mod( 'wps_custom_font_family_status' ) ) {
			return false;
		}

		$fonts_api = new WpsGetThemeFonts();

		$font_main = get_theme_mod( 'wps_main_font_family' ); // Get selected font family option.

		/* If no font is set return */
		if ( ! $font_main ) {
			return;
		} else {

			$fonts = $fonts_api->get_theme_fonts_link();
			$count = 0;
			foreach ( $fonts as $link ) {
				wp_register_style( 'wps_theme_main_font_' . $count, $link );
				wp_enqueue_style( 'wps_theme_main_font_' . $count );
				$count++;
			}
			if ( $fonts_api->get_theme_font_style() ) {
				wp_add_inline_style( 'wps_theme_main_font_0', $fonts_api->get_theme_font_style() );
			}
		}
	}

	public function wps_filter_handler( $classes ) {

		if ( get_theme_mod( 'wps_custom_font_family_status' ) ) {
			$classes[] = 'site-has-custom-font';
		}

		// Custom Navigation font
		if ( get_theme_mod( 'wps_nav_custom_font' ) ) {
			$classes[] = 'nav-has-custom-font';
		}

		return $classes;
	}

}
new WPS_Prime_Run_Theme_Fonts();
