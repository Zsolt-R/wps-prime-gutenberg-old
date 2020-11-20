<?php
/**
 * Theme Header Contact.
 *
 * @package wps_prime
 */

function wps_theme_head_contact() {

	$output = '';
	$email  = '';
	$phone  = '';
	$social = '';
	$class  = '';

	$has_phone = get_theme_mod( 'header_show_phone', false );
	$has_email = get_theme_mod( 'header_show_email', false );

	$phone_main = get_option( 'wps_phone_nr' );
	$email_main = get_option( 'wps_email_address' );

	$has_social  = get_theme_mod( 'header_utility_show_contact', false );
	$show_labels = get_theme_mod( 'header_contact_show_labels', false );

	// Cleanup phone nr

	$icons = WPS_Prime_Theme_Icon::getInstance();

	$phone_main_formatted = preg_replace( '/\s+/', '', $phone_main );

	if ( $phone_main && $has_phone ) {
		$phone = '<a class="head-utility__link wps-phone-link" href="tel:' . $phone_main_formatted . '">' . $icons::getIcon( 'phone' ) . ( $show_labels ? ' ' . $phone_main : '' ) . '</a>';
	}

	if ( $email_main && $has_email ) {
		$email = '<a class="head-utility__link wps-email-link" href="mailto:' . $email_main . '">' . $icons::getIcon( 'envelope' ) . ( $show_labels ? ' ' . $email_main : '' ) . '</a>';
	}

	if ( $has_social ) {
		$social = '<div class="head-utility-social">' . do_shortcode( '[wps_social_links target="blank" list="true" label_class="u-hide"]' ) . '</div>';
	}

	if ( ! $phone && ! $email && ! $social ) {
		return;
	}

	if ( ( $phone || $email ) && $social ) {
		$class = ' head-utility-has-social';
	}

	echo '<div class="head-utility' . $class . '">' . $phone . $email . $social . '</div>';
}
