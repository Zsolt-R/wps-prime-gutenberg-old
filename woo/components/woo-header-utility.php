<?php

class WPS_THEME_Woo_Header_Utility {

	public function __construct() {

		if ( ! wps_is_woocommerce_activated() ) {
			return;
		}

		add_action( 'wps_theme_header_right', array( $this, 'header_cart' ), 20, 2 );

		if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
			add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'cart_link_fragment' ) );
		} else {
			add_filter( 'add_to_cart_fragments', array( $this, 'cart_link_fragment' ) );
		}
	}

	public function header_cart() {

		if ( wps_is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
			?>
		<div class="woo-head-utility-wrapper">
			<?php $this->header_user(); ?>
		<ul id="site-header-cart" class="site-header-cart menu">
			
			<li class="<?php echo esc_attr( $class ); ?>">
			<?php $this->cart_link(); ?>
			</li>
			<li>
			<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
			</li>
		</ul>
		</div>
			<?php
		}
	}

	public function cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();
		$this->cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		// ob_start();
		// handheld_footer_bar_cart_link();
		// $fragments['a.footer-cart-contents'] = ob_get_clean();

		return $fragments;
	}

	public function header_user() {
		$output    = '';
		$user_icon = '<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="wps-prime-icon svg-inline--fa fa-user-circle fa-w-16"><path fill="currentColor" d="M248 104c-53 0-96 43-96 96s43 96 96 96 96-43 96-96-43-96-96-96zm0 144c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm0-240C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-49.7 0-95.1-18.3-130.1-48.4 14.9-23 40.4-38.6 69.6-39.5 20.8 6.4 40.6 9.6 60.5 9.6s39.7-3.1 60.5-9.6c29.2 1 54.7 16.5 69.6 39.5-35 30.1-80.4 48.4-130.1 48.4zm162.7-84.1c-24.4-31.4-62.1-51.9-105.1-51.9-10.2 0-26 9.6-57.6 9.6-31.5 0-47.4-9.6-57.6-9.6-42.9 0-80.6 20.5-105.1 51.9C61.9 339.2 48 299.2 48 256c0-110.3 89.7-200 200-200s200 89.7 200 200c0 43.2-13.9 83.2-37.3 115.9z" class=""></path></svg>';

		$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
		$account_url       = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );

		if ( $myaccount_page_id ) {

			$logout_url = wp_logout_url( get_permalink( $myaccount_page_id ) );

			if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
				$logout_url = str_replace( 'http:', 'https:', $logout_url );
			}
		}

		$user_utility = sprintf(
			'<div class="woo-head-utility"><a href="' . $account_url . '" title="' . __( 'My Account', 'wps-lv-426' ) . '"><span class="woo-head-utility__symbol">%s</span></a></div>',
			$user_icon
		);

		$login_label = is_user_logged_in() ? __( 'My Account', 'wps-lv-426' ) : __( 'Login', 'wps-lv-426' );

		$logout_link = is_user_logged_in() ? '<li><a class="woo-head-utility__account-logout-link" href="' . $logout_url . '">' . __( 'Logout', 'wps-lv-426' ) . '</a></li>' : '';

		$account_link = '<li><a class="woo-head-utility__account-link" href="' . $account_url . '" title="' . $login_label . '">' . $login_label . '</a></li>';

		$output = sprintf(
			'<div class="site-header-user">%1$s<ul class="site-header-user__list">%2$s%3$s</ul></div>',
			$user_utility,
			$account_link,
			$logout_link
		);

		echo $output;
	}

	public function cart_link() {

		$output    = '';
		$cart_icon = '<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="shopping-cart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="wps-prime-icon svg-inline--fa fa-shopping-cart fa-w-18"><path fill="currentColor" d="M551.991 64H144.28l-8.726-44.608C133.35 8.128 123.478 0 112 0H12C5.373 0 0 5.373 0 12v24c0 6.627 5.373 12 12 12h80.24l69.594 355.701C150.796 415.201 144 430.802 144 448c0 35.346 28.654 64 64 64s64-28.654 64-64a63.681 63.681 0 0 0-8.583-32h145.167a63.681 63.681 0 0 0-8.583 32c0 35.346 28.654 64 64 64 35.346 0 64-28.654 64-64 0-18.136-7.556-34.496-19.676-46.142l1.035-4.757c3.254-14.96-8.142-29.101-23.452-29.101H203.76l-9.39-48h312.405c11.29 0 21.054-7.869 23.452-18.902l45.216-208C578.695 78.139 567.299 64 551.991 64zM208 472c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm256 0c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm23.438-200H184.98l-31.31-160h368.548l-34.78 160z" class=""></path></svg>';
			// translators: % d: number of items in cart
		// $cart_content = wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'wps-lv-426' ), WC()->cart->get_cart_contents_count() ) );

		$cart_content = WC()->cart->get_cart_contents_count();

		$cart_utility = sprintf(
			'<div class="woo-head-utility"><span class="woo-head-utility__symbol">%s</span><span class="woo-head-utility__cart-count count">%s</span></div>',
			$cart_icon,
			$cart_content
		);

		$output .= '<a class="cart-contents" href="' . esc_url( wc_get_cart_url() ) . '" title="' . esc_attr( 'My shopping cart' ) . '">';
		$output .= $cart_utility;
		$output .= '</a>';
		// echo wp_kses_post( WC()->cart->get_cart_subtotal() );

		echo $output;
	}

}
new WPS_THEME_Woo_Header_Utility();

