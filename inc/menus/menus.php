<?php

class WPS_Prime_Menus {
	public function __construct() {
		add_action( 'widgets_init', array( $this, 'setup_menu' ) );
	}

	public function setup_menu() {

		/* This theme uses wp_nav_menu() in one location. */
		register_nav_menus(
			array(
				'primary'        => __( 'Primary Menu', 'wps-prime' ),
				'primary_mobile' => __( 'Primary Mobile Menu (set a different menu for mobile | default: Primary menu)', 'wps-prime' ),
			)
		);
	}
}

new WPS_Prime_Menus();
