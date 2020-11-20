<?php

function wps_theme_head_content_area() {

	$area = get_option( 'header_utility_content' );

	if ( ! $area ) {
		return;
	}

	echo '<section class="head-utility-content">' . do_shortcode( $area ) . '</section>';
}
