<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPS_THEME_Woo_Layout {
	public function __construct() {
		add_action( 'woocommerce_before_main_content', array( $this, 'woocommerce_single_setup' ), 10, 2 );
	}

	public function woocommerce_single_setup() {

		if ( ! wps_is_woocommerce_activated() ) {
			return;
		}

		if ( ! is_product() ) {
			return false;
		}

		// Check if the product data sections should be displayed in tabs or show all
		$switch_from_tabs = get_theme_mod( 'wps_woo_single_disable_data_tabs', false );

		if ( $switch_from_tabs ) {
			// Single Product - Remove Tabs
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

			// Add product description
			add_action( 'woocommerce_after_single_product_summary', array( $this, 'product_description' ) );

			// Add product characteristics
			add_action( 'woocommerce_after_single_product_summary', array( $this, 'product_characteristics' ) );

			// Reviews
			add_action( 'woocommerce_after_single_product_summary', array( $this, 'product_reviews' ) );

			/**
			* Remove "Description" Heading Title @ WooCommerce Single Product Tabs
			*/
			add_filter( 'woocommerce_product_description_heading', '__return_null' );
			add_filter( 'woocommerce_product_additional_information_heading', '__return_null' );
			add_filter( 'woocommerce_product_reviews_heading', '__return_null' );
		}

		// Product Single - Remove Sale Label
		// remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

		// Single Product - Add Average Rating
		// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

		 // Single Product - Add Short Description
		// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

		// Single Product - Remove Product Meta
		// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

		// Pre content area
		add_action( 'woocommerce_before_single_product', array( $this, 'wps_before_main_content' ) );
	}


	public function product_description() {

		$content = apply_filters( 'the_content', get_the_content() );

		$output = sprintf(
			'<div class="wc-single-product-description"><h2>%1$s</h2>%2$s</div>',
			__( 'Description', 'wps-lv-426' ),
			do_shortcode( $content )
		);
		echo $output;
	}

	public function product_characteristics() {

		global $product;

		$formatted_attributes = array();

		$attributes = $product->get_attributes();
		foreach ( $attributes as $attr => $attr_deets ) {
			$attribute_label = wc_attribute_label( $attr );
			if ( isset( $attributes[ $attr ] ) || isset( $attributes[ 'pa_' . $attr ] ) ) {
				$attribute = isset( $attributes[ $attr ] ) ? $attributes[ $attr ] : $attributes[ 'pa_' . $attr ];
				if ( $attribute['is_taxonomy'] ) {
					$formatted_attributes[ $attribute_label ] = implode( ', ', wc_get_product_terms( $product->get_id(), $attribute['name'], array( 'fields' => 'names' ) ) );
				} else {
					$formatted_attributes[ $attribute_label ] = $attribute['value'];
				}
			}
		}
		$output  = '';
		$output .= '<div class="wc-spsw-item wc-single-product-summary-wrapper-attributes">';
		$output .= '<h2>' . __( 'Attributes', 'wps-lv-426' ) . '</h2>';
		$output .= '<div class="woo-table-responsive">';
		$output .= '<table class="woocommerce-product-attributes shop_attributes">';
		foreach ( $formatted_attributes as $key => $value ) {
			$output     .= '<tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--' . $key . '">';
				$output .= '<th class="woocommerce-product-attributes-item__label">' . $key . '</th>';
				$output .= '<td class="woocommerce-product-attributes-item__value">' . $value . '</td>';
			$output     .= '</tr>';
		}
		$output .= '</table>';
		$output .= '</div>';
		$output .= '</div>';
		echo $output;
	}

	function product_reviews( $product ) {

		if ( ! wc_review_ratings_enabled() ) {
			return;
		}?>	

		<div class="wc-spsw-item wc-single-product-summary-wrapper-reviews">			
		<div class="wc-single-product-summary-wrapper-reviews-items">	
			<?php WPS_THEME_Woo_Reviews::display_review_count(); ?>
			<?php WPS_THEME_Woo_Reviews::display_review_list(); ?>
			</div>
			<div id="reviews" class="woocommerce-reviews">			
			<?php WPS_THEME_Woo_Reviews::display_review_form(); ?>
			</div>
		</div>
		<?php
	}
	// Before content area
	public function wps_before_main_content() {

		$content = get_option( 'wps_woo_single_header_start_area', false );

		if ( ! $content ) {
			return;
		}

		$content = sprintf(
			'<div class="woo-pre-single-content"><div class="woo-pre-single-content__inner">%1$s</div></div>',
			do_shortcode( $content )
		);

		echo $content;
	}
}
	new WPS_THEME_Woo_Layout();
