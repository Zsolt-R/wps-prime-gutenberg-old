<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class WPS_Woo_General_Layout {
	public function __construct() {

		if ( ! woo_switch() ) {
			return;
		}

		add_action( 'woocommerce_before_main_content', array( $this, 'woocommerce_general_setup' ), 10, 2 );

		add_filter( 'body_class', array( $this, 'body_class' ) );

		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

		add_action( 'woocommerce_before_main_content', array( $this, 'wrapper_start' ), 10 );
		add_action( 'woocommerce_after_main_content', array( $this, 'wrapper_end' ), 10 );

		/**
		 * Single
		 */
		// .woocommerce-single-product-top-layout
		add_action( 'woocommerce_before_single_product_summary', array( $this, 'single_layout_top_wrap' ), 10 );
		add_action( 'woocommerce_after_single_product_summary', array( $this, 'single_wrapper_end' ), 10 );

		// .woocommerce-single-product-add-to-cart-layout
		add_action( 'woocommerce_before_add_to_cart_button', array( $this, 'single_add_to_cart_start' ), 10 );
		add_action( 'woocommerce_after_add_to_cart_button', array( $this, 'single_wrapper_end' ), 10 );

		// .woocommerce-single-product-bottom-layout
		add_action( 'woocommerce_after_single_product_summary', array( $this, 'single_layout_bottom_wrap' ), 10 );
		add_action( 'woocommerce_after_single_product', array( $this, 'single_wrapper_end' ), 10 );

	}

	public function woocommerce_general_setup() {

		$hide_breadcrumb = get_theme_mod( 'wps_woo_hide_breadcrumb', false );
		$hide_rating     = get_theme_mod( 'wps_woo_shop_hide_rating', false );

		// Remove Breadcrumbs
		if ( $hide_breadcrumb ) {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		}

		// Remove the product rating display on product loops
		if ( $hide_rating ) {
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		}

	}

	public function body_class( $classes ) {

		if ( is_product() || is_cart() || is_checkout() || is_account_page() ) {
			return $classes;
		}

		$shop_layout_switch = get_theme_mod( 'wps_woo_shop_layout_switch', false );

		if ( 'product' === get_post_type() && is_active_sidebar( 'sidebar-shop' ) ) {
			$classes[] = 'woocommerce-has-sidebar';
		}

		if ( 'product' === get_post_type() && is_active_sidebar( 'sidebar-shop' ) && $shop_layout_switch ) {
			$classes[] = 'woocommerce-layout-switch';
		}

		return $classes;
	}


	public function wrapper_start() {

		echo '<div id="primary" class="content-area"><main id="main" class="site-main">';
	}

	public function wrapper_end() {

		echo '</main></div>';
	}

	public function single_wrapper_end() {

		echo '</div>';
	}

	/**
	 * Single Product
	 */
	public function single_layout_top_wrap() {

		echo '<div class="woocommerce-single-product-top-layout">';
	}

	/**
	 * Single product add to cart wrap
	 */
	public function single_add_to_cart_start() {

		echo '<div class="woocommerce-single-product-add-to-cart-layout">';
	}

	/**
	 * Single product bottom wrap
	 */
	public function single_layout_bottom_wrap() {

		echo '<div class="woocommerce-single-product-bottom-layout">';
	}
}

new WPS_Woo_General_Layout();
