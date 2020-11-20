<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class WPS_Woo_My_Account_Layout {
	public function __construct() {
		add_action( 'woocommerce_account_navigation', array( $this, 'wrapper_start' ), 1 );
		add_action( 'woocommerce_account_dashboard', array( $this, 'wrapper_end' ), 99 );
	}

	public function wrapper_start() {
		echo '<div class="wps-woo-my-account-wrapper">';
	}

	public function wrapper_end() {
		echo '</div>';
	}
}

new WPS_Woo_My_Account_Layout();
