<?php
/**
 * Theme Footer Micro Copy.
 *
 * Contains the parts whitch are added to the theme footer area
 *
 * @package wps_prime
 */

/**
 * Site footer closing data line
 */

function wps_site_disclaimer() {
	$option = get_option( 'wps_site_disclaimer' );
	if ( ! $option ) {
		return false;
	}
	return '<div class="site-disclaimer">' . do_shortcode( $option ) . '</div>';
}

if ( ! function_exists( 'wps_theme_footer_micro' ) ) {

	/**
	 * Site footer closing data line
	 */
	function wps_theme_footer_micro() { ?>    
		<div class="page-micro">           
				<div class="page-micro__copy"><?php echo wps_site_disclaimer(); ?></div>          
		</div><!-- page-micro -->    
		<?php
	}
}
