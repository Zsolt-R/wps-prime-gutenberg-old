<?php

class WPS_THEME_Woo_Single_Image_Gallery {

	public function __construct() {
		// Remove default gallery and add new gallery
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
		add_action( 'woocommerce_before_single_product_summary', array( $this, 'run_gallery' ), 20 );
	}

	/**
	 * Get the gallery attachment ID
	 */
	private function gallery_ids() {
		global $product;
		$attachment_ids = $product->get_gallery_image_ids();
		return $attachment_ids;
	}

	/**
	 * Get the featured image ID
	 */
	private function thumbnail_id() {
		global $product;
		$post_thumbnail_id = $product->get_image_id();
		return $post_thumbnail_id;
	}

	/**
	 * Setup placeholder Image
	 */
	private function placeholder_image() {
		$output  = '';
		$output .= '<div class="woocommerce-product-gallery__image--placeholder">';
		$output .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
		$output .= '</div>';

		return $output;
	}

	/**
	 * Prepare image id list
	 */
	private function image_ids() {
		$attachments_list = array();

		$attachment_ids    = $this->gallery_ids();
		$post_thumbnail_id = $this->thumbnail_id();

		// Add post thumbnail
		if ( $post_thumbnail_id ) {
			$attachments_list[] = $post_thumbnail_id;
		}

		// combine with the image list
		if ( ! empty( $attachment_ids ) ) {
			$attachments_list = array_merge( $attachment_ids, $attachments_list );
		}

		return $attachments_list;
	}

	/**
	 * Generate slider slides
	 */
	private function slider_image_list( $image_size = 'woocommerce_single', $fancybox = false ) {
		$output = '';

		$image_ids = $this->image_ids();
		if ( $image_ids ) {
			foreach ( $image_ids as $id ) {

				$image = wp_get_attachment_image_src( $id, $image_size );

				if ( $fancybox ) {
					$image_full = wp_get_attachment_image_src( $id, 'full' );
					$output    .= sprintf(
						'<div data-fancybox="wps-woo-product-gallery" data-src="%1$s" class="swiper-slide" style="background-image:url(%2$s)"></div>',
						$image_full[0],
						$image[0]
					);
				} else {
					$output .= sprintf(
						'<div class="swiper-slide" style="background-image:url(%s)"></div>',
						$image[0]
					);
				}
			}
		}
		return $output;
	}

	/**
	 * Create main image carousel
	 */
	private function main_carousel() {
		$output = $this->slider_image_list( 'woocommerce_single', true );
		return $output;
	}

	/**
	 * Create thumbnail image carousel
	 */
	private function thumbnail_carousel() {
		$output = $this->slider_image_list( 'woocommerce_gallery_thumbnail' );
		return $output;
	}

	private function gallery() {

		$html = '';

		// If no featured image show placeholder
		if ( ! $this->thumbnail_id() ) {
			return '<div class="woo-single-image-gallery">' . $this->placeholder_image() . '</div>';
		}

		// $html .= wc_get_gallery_image_html( $post_thumbnail_id, true );
		// } else {
		// $html .= $this->placeholder_image();
		// }

		// $html .= apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );

		// if ( $attachment_ids && $post_thumbnail_id ) {
		// foreach ( $attachment_ids as $attachment_id ) {
		// $html .= apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
		// }
		// }

		$html .= '<div class="woo-single-image-gallery">';
		$html .= '<div class="swiper-container wps-lv-426-woo-gallery-main">';
		$html .= '<div class="swiper-wrapper">';
		$html .= $this->main_carousel();
		$html .= '</div>';
		$html .= '<div class="swiper-button-next"></div>';
		$html .= '<div class="swiper-button-prev"></div>';
		$html .= '</div>';

		$html .= '<div class="swiper-container wps-lv-426-woo-gallery-thumbs">';
		$html .= '<div class="swiper-wrapper">';
		$html .= $this->thumbnail_carousel();
		$html .= '</div>';
		$html .= '</div>';

		$html .= '</div>';

		return $html;
	}

	public function run_gallery() {
		echo $this->gallery();
	}
}
new WPS_THEME_Woo_Single_Image_Gallery();
