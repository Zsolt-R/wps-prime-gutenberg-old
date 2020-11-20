<?php

/**
 * Theme Header css class function
 * Separates classes with a single space, collates classes for element
 *
 * @param array $class CSS Classes for element.
 */
function wps_prime_theme_header_class( $class = '' ) {

	$classes = join( ' ', WPS_Prime_Tools::generate_css_class( $class, 'wps_prime_theme_header_class' ) );

	return ' class="' . esc_attr( $classes ) . '"';
}

function wps_prime_theme_header_left_class( $class = '' ) {

	$classes = join( ' ', WPS_Prime_Tools::generate_css_class( $class, 'wps_prime_theme_header_left_class' ) );

	return ' class="' . esc_attr( $classes ) . '"';
}

function wps_prime_theme_header_right_class( $class = '' ) {

	$classes = join( ' ', WPS_Prime_Tools::generate_css_class( $class, 'wps_prime_theme_header_right_class' ) );

	return ' class="' . esc_attr( $classes ) . '"';
}

/**
 * Theme Main Site content class
 * Separates classes with a single space, collates classes for element
 * uses return and not echo because it is being called in an echo statement
 * and would result in double echo
 *
 * @param array $class CSS Classes for element.
 * @return string
 */
function wps_prime_theme_main_content_class( $class = '' ) {

	$classes = join( ' ', WPS_Prime_Tools::generate_css_class( $class, 'wps_prime_theme_main_content_class' ) );

	return ' class="' . esc_attr( $classes ) . '"';
}

/**
 * Theme Main Content layout css class function
 * Separates classes with a single space, collates classes for element
 *
 * @param array|string $class CSS Classes for element.
 * @return string
 */
function wps_prime_theme_entry_content_class( $class = '' ) {

	$classes = join( ' ', WPS_Prime_Tools::generate_css_class( $class, 'wps_prime_theme_entry_content_class' ) );

	return ' class="' . esc_attr( $classes ) . '"';
}

/**
 * Theme Main Sidebar layout css class function
 * Separates classes with a single space, collates classes for element
 *
 * @param array $class CSS Classes for element.
 */
function wps_prime_theme_main_sidebar_class( $class = '' ) {

	$classes = join( ' ', WPS_Prime_Tools::generate_css_class( $class, 'wps_prime_theme_main_sidebar_class' ) );

	return ' class="' . esc_attr( $classes ) . '"';
}

/**
 * Theme Main Site footer class
 * Separates classes with a single space, collates classes for element
 * uses return and not echo because it is being called in an echo statement
 * and would result in double echo
 *
 * @param array $class CSS Classes for element.
 * @return string
 */
function wps_prime_theme_footer_class( $class = '' ) {

	$classes = join( ' ', WPS_Prime_Tools::generate_css_class( $class, 'wps_prime_theme_footer_class' ) );

	return ' class="' . esc_attr( $classes ) . '"';
}

/**
 * Theme main navigation css class function
 * Separates classes with a single space, collates classes for element
 *
 * @param array|string $class CSS Classes for element.
 * @return string
 */
function wps_prime_theme_nav_class( $class = '' ) {

	$classes = join( ' ', WPS_Prime_Tools::generate_css_class( $class, 'wps_prime_theme_nav_class' ) );

	return ' class="' . esc_attr( $classes ) . '"';
}

/**
 * Theme main mobile navigation css class function
 * Separates classes with a single space, collates classes for element
 *
 * @param array|string $class CSS Classes for element.
 * @return string
 */
function wps_prime_theme_mobile_nav_class( $class = '' ) {

	$classes = join( ' ', WPS_Prime_Tools::generate_css_class( $class, 'wps_prime_theme_mobile_nav_class' ) );

	return ' class="' . esc_attr( $classes ) . '"';
}
