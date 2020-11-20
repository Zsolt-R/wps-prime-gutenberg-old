<?php
add_shortcode( 'wps_get_the_date', 'wps_get_the_date_shortcode' );
function wps_get_the_date_shortcode( $atts ) {

	$options = shortcode_atts(
		array(
			'format' => 'Y',
			'return' => true,
		),
		$atts,
		'wps_get_the_date'
	);

	$date = date( $options['format'] );

	if ( 'false' === $options['return'] ) {
		echo $date;
	} else {
		return $date;
	}
}
