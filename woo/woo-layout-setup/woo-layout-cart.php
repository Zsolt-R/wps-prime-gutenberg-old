<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class WPS_Woo_General_Cart {
	public function __construct() {

		add_action( 'woocommerce_before_cart', array( $this, 'wrapper_top' ), 10 );
		add_action( 'woocommerce_before_cart_collaterals', array( $this, 'wrapper_end' ), 99 );

		// Relocate totals to the right of produt list
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
		add_action( 'woocommerce_before_cart_collaterals', 'woocommerce_cart_totals', 10 );
	}

	/**
	 * Cart
	 */
	public function wrapper_top() {
		echo '<div class="woocommerce-cart-top-layout">';
	}
	public function wrapper_end() {
		echo '</div>';
	}
}
new WPS_Woo_General_Cart();
