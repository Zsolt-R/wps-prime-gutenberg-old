<?php
	/**
	 * Query WooCommerce activation
	 */
function wps_is_woocommerce_activated() {
	return class_exists( 'WooCommerce' ) ? true : false;
}
function woo_switch() {

	$woo_active_status = wps_is_woocommerce_activated();

	// Check if WPS woo is enabled from config and woocommerce is activated
	if ( $woo_active_status ) {
		return true;
	}
	return false;
}

if ( woo_switch() ) {

	add_action( 'wp_enqueue_scripts', 'wps_add_woo_scripts' );
	function wps_add_woo_scripts() {
		// if Woocommerce form
		if ( wps_is_woocommerce_activated() ) {
			wp_enqueue_style( 'wps-woocommerce-css', THEME_URI . '/wps-woocommerce.css', array(), WPS_PRIME_THEME_VERSION );
			wp_register_script( 'wps-woocommerce-js', THEME_URI . '/assets/dist/js/min/wps-woocommerce.min.js', array( 'jquery', 'wps-slider-core', 'wps-fancybox-pack-js' ), WPS_PRIME_THEME_VERSION, true );
			wp_enqueue_script( 'wps-woocommerce-js' );
		}
	}

	// Disable Woo styles
	add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

	/**
	 * Remove Woocommerce Select2 - Woocommerce 3.2.1+
	 */
	function wps_theme_dequeue_select2() {
		if ( class_exists( 'woocommerce' ) ) {
			wp_dequeue_style( 'select2' );
			wp_deregister_style( 'select2' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'wps_theme_dequeue_select2', 100 );

	// Setup woo
	require_once THEME_DIR . '/woo/helpers/woo-helpers.php';
	require_once THEME_DIR . '/woo/components/woo-reviews.php';
	require_once THEME_DIR . '/woo/components/woo-header-utility.php';
	require_once THEME_DIR . '/woo/components/woo-single-gallery.php';
	require_once THEME_DIR . '/woo/components/woo-category-description.php';
	require_once THEME_DIR . '/woo/woo-layout-setup/woo-layout-single.php';
	require_once THEME_DIR . '/woo/woo-layout-setup/woo-layout-my-account.php';
	require_once THEME_DIR . '/woo/woo-layout-setup/woo-layout-cart.php';
	require_once THEME_DIR . '/woo/woo-layout-setup/woo-layout-checkout.php';
}

require_once THEME_DIR . '/woo/woo-layout-setup/woo-layout-general.php';
