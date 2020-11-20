<?php

/**
 *    20 Social Links.
 */
add_shortcode( 'wps_social_links', 'wps_social_links_shortcode' );
function wps_social_links_shortcode( $atts ) {
	$options = shortcode_atts(
		array(
			'list'        => false,
			'link_class'  => '',
			'label_class' => '',
			'target'      => '',
			'list_class'  => '',
		),
		$atts
	);

	$output = $listStart = $listEnd = $listItemStart = $listItemEnd = '';

	$hidelabel = $options['list'] ? '' : 'u-hide';

	$classLink  = WPS_Prime_Tools::generate_css_classes( array( 'c-social-list__link', $options['link_class'] ), true );
	$classList  = WPS_Prime_Tools::generate_css_classes( array( 'c-social-list', $options['list_class'] ), true );
	$classLabel = WPS_Prime_Tools::generate_css_classes( array( 'c-social-list__label', $options['label_class'], $hidelabel ), true );

	$target = $options['target'] ? ' target="_blank"' : '';

	$facebook    = get_option( 'wps_social_link_facebook' );
	$instagram   = get_option( 'wps_social_link_instagram' );
	$twitter     = get_option( 'wps_social_link_twitter' );
	$linkedIn    = get_option( 'wps_social_link_linkedin' );
	$gmybusiness = get_option( 'wps_social_link_gbusiness' );
	$youtube     = get_option( 'wps_social_link_youtube' );
	$flickr      = get_option( 'wps_social_link_flickr' );
	$vimeo       = get_option( 'wps_social_link_vimeo' );
	$pinterest   = get_option( 'wps_social_link_pinterest' );
	$medium      = get_option( 'wps_social_link_medium' );

	if ( $options['list'] ) {
		$listStart     = '<ul class="' . $classList . '">';
		$listEnd       = '</ul>';
		$listItemStart = '<li class="c-social-list__item">';
		$listItemEnd   = '</li>';
	}

	$social_icon = '';

	$instance = WPS_Prime_Theme_Icon::getInstance();

	if ( $facebook ) {
		$social_icon = $instance::getIcon( 'facebook' );
		$output     .= $listItemStart . '<a href="' . $facebook . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">Facebook</span></a>' . $listItemEnd;
	}

	if ( $instagram ) {
		$social_icon = $instance::getIcon( 'instagram' );
		$output     .= $listItemStart . '<a href="' . $instagram . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">Instagram</span></a>' . $listItemEnd;
	}

	if ( $twitter ) {
		$social_icon = $instance::getIcon( 'twitter' );
		$output     .= $listItemStart . '<a href="' . $twitter . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">Twitter</span></a>' . $listItemEnd;
	}

	if ( $linkedIn ) {
		$social_icon = $instance::getIcon( 'linkedin' );
		$output     .= $listItemStart . '<a href="' . $linkedIn . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">LinkedIn</span></a>' . $listItemEnd;
	}

	if ( $gmybusiness ) {
		$social_icon = $instance::getIcon( 'google' );
		$output     .= $listItemStart . '<a href="' . $gmybusiness . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">My Business</span></a>' . $listItemEnd;
	}

	if ( $youtube ) {
		$social_icon = $instance::getIcon( 'youtube' );
		$output     .= $listItemStart . '<a href="' . $youtube . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">Youtube</span></a>' . $listItemEnd;
	}

	if ( $vimeo ) {
		$social_icon = $instance::getIcon( 'vimeo' );
		$output     .= $listItemStart . '<a href="' . $vimeo . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">Vimeo</span></a>' . $listItemEnd;
	}

	if ( $flickr ) {
		$social_icon = $instance::getIcon( 'flickr' );
		$output     .= $listItemStart . '<a href="' . $flickr . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">Flickr</span></a>' . $listItemEnd;
	}

	if ( $pinterest ) {
		$social_icon = $instance::getIcon( 'pinterest' );
		$output     .= $listItemStart . '<a href="' . $pinterest . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">Pinterest</span></a>' . $listItemEnd;
	}

	if ( $medium ) {
		$social_icon = $instance::getIcon( 'medium' );
		$output     .= $listItemStart . '<a href="' . $medium . '"' . $target . ' class="' . $classLink . '">' . $social_icon . '<span class="' . $classLabel . '">Medium</span></a>' . $listItemEnd;
	}

	$output = $listStart . $output . $listEnd;

	return $output;
}
