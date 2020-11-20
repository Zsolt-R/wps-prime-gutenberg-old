<?php

function wps_theme_translator_switcher( $echo = true ) {
	$output  = '';
	$output .= '<div class="translator-utility-wrapper"><div class="translator-utility">';
	$output .= do_shortcode( '[wpml_language_selector_widget]' );
	$output .= '</div></div>';
	echo $output;
}
