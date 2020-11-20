<?php

class WPS_Prime_Front_End_Setup {

	public function __construct() {
		add_filter( 'body_class', array( $this, 'site_settings' ) );
		add_filter( 'body_class', array( $this, 'page_settings' ) );
		add_filter( 'wps_prime_theme_header_class', array( $this, 'main_header' ) );
		add_filter( 'wps_prime_theme_header_left_class', array( $this, 'main_header_left' ) );
		add_filter( 'wps_prime_theme_header_right_class', array( $this, 'main_header_right' ) );
		add_filter( 'wps_prime_theme_nav_class', array( $this, 'main_nav_class' ) );
		add_filter( 'wps_prime_theme_mobile_nav_class', array( $this, 'main_mobile_nav_class' ) );
		add_filter( 'wps_prime_theme_main_content_class', array( $this, 'main_content_class' ) );
		add_filter( 'wps_prime_theme_main_sidebar_class', array( $this, 'main_sidebar_class' ) );
		add_filter( 'wps_prime_theme_entry_content_class', array( $this, 'entry_content_class' ) );
		add_filter( 'wps_prime_theme_footer_class', array( $this, 'footer_class' ) );
	}

	public function site_settings( $classes ) {
		$post_id = get_the_ID();

		$header_bg_color        = get_theme_mod( 'wps_header_background', '#ffffff' );
		$header_use_sticky      = get_theme_mod( 'header_use_sticky', false );
		$header_sticky_bg_color = get_theme_mod( 'wps_header_background_sticky', '#000000' );
		$bg_color               = WPS_Prime_Tools::contrast_color( $header_bg_color );
		$sticky_bg_color        = WPS_Prime_Tools::contrast_color( $header_sticky_bg_color );

		// check header bg color
		if ( 'light' === $bg_color ) {
			$classes[] = 'has-header-light';
		} elseif ( 'dark' === $bg_color ) {
			$classes[] = 'has-header-dark';
		}

		// check stricky header bg color
		if ( $header_use_sticky ) {
			if ( 'light' === $sticky_bg_color ) {
				$classes[] = 'has-sticky-header-light';
			} elseif ( 'dark' === $sticky_bg_color ) {
				$classes[] = 'has-sticky-header-dark';
			}
		}

		return $classes;
	}

	/**
	 *   Add padding top Enable/Disable to main content area
	 */
	public function page_settings( $classes ) {
		if ( is_page() || is_404() ) {

			$page_id = get_option( 'wps_404_custom_page' );
			$pid     = get_the_ID() ? get_the_ID() : $page_id;

			$title_vis = get_post_meta( $pid, '_wps_prime_hide_title', true );
			$get_mt    = get_post_meta( $pid, '_wps_prime_page_margin_top_reset', true );
			$get_mb    = get_post_meta( $pid, '_wps_prime_page_margin_bottom_reset', true );

			if ( $get_mt && ! $get_mb ) {
				$classes[] = 'reset-space-top';
			}

			if ( $get_mb && ! $get_mt ) {
				$classes[] = 'reset-space-bottom';
			}

			if ( $get_mt && $get_mb ) {
				$classes[] = 'reset-space-vertical';
			}
			if ( $title_vis ) {
				$classes[] = 'hide-page-title';
			}
		}
		return $classes;
	}

	public function main_header( $classes ) {
		$classes[] = 'site-header';
		return $classes;
	}
	public function main_header_left( $classes ) {
		$classes[] = 'site-header__left';
		return $classes;
	}
	public function main_header_right( $classes ) {
		$classes[] = 'site-header__right';
		return $classes;
	}
	public function main_nav_class( $classes ) {
		$classes[] = 'site-nav';
		return $classes;
	}

	public function main_mobile_nav_class( $classes ) {
		$classes[] = 'site-nav-mobile c-slide-nav c-slide-nav--slide-right';
		return $classes;
	}


	public function main_content_class( $classes ) {
		$classes[] = 'site-content';
		return $classes;
	}

	public function main_sidebar_class( $classes ) {
		$classes[] = 'main-sidebar';
		$classes[] = 'widget-area';
		return $classes;
	}

	public function entry_content_class( $classes ) {
		$classes[] = 'content-area';
		return $classes;
	}

	public function footer_class( $classes ) {
		$classes[] = 'site-footer';
		return $classes;
	}

}

new WPS_Prime_Front_End_Setup();
