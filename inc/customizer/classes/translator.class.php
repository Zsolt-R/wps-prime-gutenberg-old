<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since Child Theme 1.0
 */
if ( function_exists( 'icl_object_id' ) ) {
	add_action( 'customize_register', array( 'WPS_Customizer_Translator_Setup', 'register' ) );
}

class WPS_Customizer_Translator_Setup {

	public static function register( $wp_customize ) {

		$wp_customize->add_section(
			'wps_translator_settings',
			array(
				'title'      => __( 'Translator setup', 'wps-prime' ), // Visible title of section
				'capability' => 'edit_theme_options', // Capability needed to tweak
			)
		);

		/**
		 * Add settings
		 */
		$wp_customize->add_setting(
			'translation_switcher_display',
			array(
				'default'    => false,
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'refresh',
			)
		);

		$wp_customize->add_control(
			'translation_switcher_display',
			array(
				'type'        => 'checkbox',
				'section'     => 'wps_translator_settings',
				'label'       => __( 'Add language switcher to header and mobile menu sidebar', 'wps-prime' ),
				'description' => __( 'You have to configure "Custom language switchers options" under languages in WPML', 'wps-prime' ) . ' <a href="' . get_admin_url() . 'admin.php?page=sitepress-multilingual-cms%2Fmenu%2Flanguages.php#wpml-language-switcher-shortcode-action" target="_blank" title="Open in new tab">go to setting</a>',
			)
		);

	}

}
