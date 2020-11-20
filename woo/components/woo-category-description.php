<?php

class WPS_THEME_Woo_Category_Description {
	public function __construct() {

		if ( ! wps_is_woocommerce_activated() ) {
			return;
		}

		add_action( 'woocommerce_before_main_content', array( $this, 'setup_description' ), 10, 2 );

	}

	public function setup_description() {
		$bottom = get_theme_mod( 'woocommerce_shop_page_cat_descr_position', false );
		$hide   = get_theme_mod( 'woocommerce_shop_page_cat_descr_hide', false );

		if ( $bottom && ! $hide ) {
			remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description' );
			add_action( 'woocommerce_after_shop_loop', 'woocommerce_taxonomy_archive_description' );
		}
		if ( $hide ) {
			remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description' );
		}
	}


	public function description() {
		echo 'description';
	}
}
new WPS_THEME_Woo_Category_Description();

// Overwrite woo description
function woocommerce_taxonomy_archive_description() {

	if ( ! wps_is_woocommerce_activated() ) {
		return;
	}

	if ( is_product_taxonomy() && 0 === absint( get_query_var( 'paged' ) ) ) {
		$term = get_queried_object();

		if ( $term && ! empty( $term->description ) ) {
			$output = sprintf(
				'<div class="term-description term-description-has-read-more">
                <div class="term-description__content">%1$s</div>
                <div class="term-description__button">

                <div class="term-description__read-more"><span class="term-description__label">%2$s</span><span class="term-description__symbol"></span></div>
                
                </div>                
                </div>', // WPCS: XSS ok.
				wc_format_content( $term->description ),
				__( 'Read more', 'wps-lv-426' )
			);
			echo $output;
		}
	}
}
