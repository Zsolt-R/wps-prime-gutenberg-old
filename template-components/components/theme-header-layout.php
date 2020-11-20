<?php
/**
 * Theme Header Parts.
 *
 * Contains the parts whitch are added to the theme header area
 *
 * @package wps_prime
 */

/**
 * Site header Layout
 */
if ( ! function_exists( 'wps_theme_layout_header' ) ) :
	function wps_theme_layout_header() {

		/**
		 * If hook doesn't has action hide the html
		 */
		if ( has_action( 'wps_theme_header_left' ) === true ) {

			echo '<div' . wps_prime_theme_header_left_class() . '>';
				wps_theme_header_left();
			echo '</div>';
		}

		if ( has_action( 'wps_theme_header_right' ) === true ) {

			echo '<div' . wps_prime_theme_header_right_class() . '><div class="header-items-wrapper">';
				wps_theme_header_right();
			echo '</div></div>';
		}
	}
endif;
