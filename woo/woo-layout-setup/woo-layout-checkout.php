<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class WPS_Woo_Checkout_Layout {
	public function __construct() {

		add_action( 'woocommerce_before_checkout_billing_form', array( $this, 'wrapper_start' ), 10 );
		add_action( 'woocommerce_after_checkout_billing_form', array( $this, 'wrapper_end' ), 10 );

		// Checkout forms layout

		add_action( 'woocommerce_checkout_before_customer_details', array( $this, 'wrapper_layout_left_start' ), 10 );
		add_action( 'woocommerce_checkout_before_order_review_heading', array( $this, 'wrapper_layout_right_start' ), 10 );

		add_action( 'woocommerce_checkout_after_customer_details', array( $this, 'wrapper_end' ), 10 );
		add_action( 'woocommerce_checkout_after_order_review', array( $this, 'wrapper_end' ), 10 );

	}


	public function wrapper_start() {
		echo '<div class="wps-woo-form-wrapper">';
	}

	public function wrapper_layout_start() {
		echo '<div class="woocommerce-checkout-layout">';
	}
	public function wrapper_layout_left_start() {
		echo '<div class="woocommerce-checkout-layout__left">';
	}
	public function wrapper_layout_right_start() {
		echo '<div class="woocommerce-checkout-layout__right">';
	}

	public function wrapper_end() {
		echo '</div>';
	}


	// Remove billing details and additional notes section.


	public function remove_billing_info_and_additional_notes_wc() {
		if ( ! ( is_admin() ) ) {
			// Run this code only in frontend
			global $woocommerce;
			if ( is_object( $woocommerce ) ) {

				// WooCommerce Plugin activated
				if ( function_exists( 'WC' ) ) {

					$wc_checkout_instance = WC()->checkout();
					// Remove hooks
					// remove_action( 'woocommerce_checkout_billing', array( $wc_checkout_instance, 'checkout_form_billing' ) );
					remove_action( 'woocommerce_checkout_shipping', array( $wc_checkout_instance, 'checkout_form_shipping' ) );

					add_action( 'woocommerce_checkout_billing', array( $wc_checkout_instance, 'checkout_form_shipping' ) );

				}
			}
		}
	}
}

new WPS_Woo_Checkout_Layout();
