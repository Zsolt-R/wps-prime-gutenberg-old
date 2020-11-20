<?php

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */

 /* Register sidebar widget areas */
add_action( 'widgets_init', 'child_register_theme_widgets' );
function child_register_theme_widgets() {
	if ( class_exists( 'WooCommerce' ) ) {

		register_sidebar(
			array(
				'name'          => __( 'Sidebar Shop', 'wps-lv-426' ),
				'id'            => 'sidebar-shop',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}
}
