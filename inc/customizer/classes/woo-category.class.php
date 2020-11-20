<?php

add_action( 'customize_register', array( 'WPS_Child_Customize_Woocommerce_Category_Product', 'register' ) );

class WPS_Child_Customize_Woocommerce_Category_Product {

	public static function register( $wp_customize ) {

		$wp_customize->add_setting(
			'woocommerce_shop_page_cat_descr_position',
			array(
				'default'    => false,
				'type'       => 'theme_mod',
				'capability' => 'manage_woocommerce',
				'transport'  => 'refresh',
			)
		);

		$wp_customize->add_control(
			'woocommerce_shop_page_cat_descr_position',
			array(
				'label'       => __( 'Archive description to bottom', 'wps-prime' ),
				'description' => __( 'Set to show the archive description after the product list.', 'wps-prime' ),
				'section'     => 'woocommerce_product_catalog',
				'type'        => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'woocommerce_shop_page_cat_descr_hide',
			array(
				'default'    => false,
				'type'       => 'theme_mod',
				'capability' => 'manage_woocommerce',
				'transport'  => 'refresh',
			)
		);

		$wp_customize->add_control(
			'woocommerce_shop_page_cat_descr_hide',
			array(
				'label'       => __( 'Archive description hide', 'wps-prime' ),
				'description' => __( 'Do not show the archive description.', 'wps-prime' ),
				'section'     => 'woocommerce_product_catalog',
				'type'        => 'checkbox',
			)
		);

	}
}
