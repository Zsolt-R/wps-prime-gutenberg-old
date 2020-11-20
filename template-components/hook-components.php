<?php
/**
 *
 *   HOOK OBJECTS TO THEME
 *   used to add custom theme-parts via hooks
 *
 * @package wps_prime
 */

/**
 *  BODY Hooks
 *  - wps_body_start
 *    ....
 *  - wps_wp_footer
 *
 *  HEADER Hooks layout
 *
 *  - wps_before_header
 *  - wps_mast_head_start
 *      - wps_theme_header
 *        - wps_header-left
 *        - wps_header-right
 *  - wps_mast_head_start
 *
 *  INTERMEDIATE Hooks after header before content
 *
 *  - wps_after_header
 *  - wps_before_content
 *
 *  MAIN CONTENT Hooks layout
 *
 *   - wps_content_start
 *   - wps_content_end
 *   - wps_single_entry_header
 *   - wps_single_entry_footer
 *   - wps_after_content
 *
 *  MAIN SIDEBAR Hooks layout
 *
 *   - wps_sidebar_start
 *   - wps_sidebar_end
 *
 *  FOOTER Hooks layout
 *
 *   - wps_before_footer
 *   - wps_footer_start
 *   - wps_footer_end
 *   - wps_after_footer
 */

/**
 * Get theme settings
 */

$footer_micro_status = get_theme_mod( 'hide_footer_micro', false );
$menu_type           = get_theme_mod( 'main_menu_type', 'menu_type1' );

/**
 * Defaults
 */
$menu_location = 'wps_theme_header_right'; // 'menu_type_1'

/**
 * Hook Header Layout to theme header
 */
add_action( 'wps_theme_header', 'wps_theme_layout_header' );

/**
 * Hook logo To theme_header_left
 */
add_action( 'wps_theme_header_left', 'wps_theme_site_logo' );

/**
 * Hook theme_header_right
 */

if ( 'menu_type_2' === $menu_type ) { // default 'wps_theme_header_right'
	$menu_location = 'wps_after_header';
}
add_action( $menu_location, 'wps_theme_main_site_nav' );
add_action( 'wps_theme_header_right', 'wps_theme_head_content_area' );
add_action( 'wps_theme_header_right', 'wps_theme_head_contact' );

if ( function_exists( 'icl_object_id' ) ) {
	if ( get_theme_mod( 'translation_switcher_display', false ) ) {
		add_action( 'wps_theme_header_right', 'wps_theme_translator_switcher', 90 );
	}
}
add_action( 'wps_theme_header_right', 'wps_theme_main_site_mobile_nav_toggler', 99 );
add_action( 'wps_after_header', 'wps_theme_slide_push_menu' );
add_action( 'wp_footer', 'wps_theme_slide_push_menu_mask' );


/**
 * Page pre content
 */
add_action( 'wps_before_content', 'wps_theme_page_pre_content' );

/**
 * Add Global Content Object
 */
add_action( 'wps_before_header', 'wps_theme_global_content_start_area' );
add_action( 'wps_before_footer', 'wps_theme_global_content_end_area' );

/**
 * Main Footer
 */
add_action( 'wps_footer_content', 'wps_theme_footer' );

/**
 *  Footer Parts
 */
if ( ! $footer_micro_status ) {
	add_action( 'wps_after_footer', 'wps_theme_footer_micro' );
}

