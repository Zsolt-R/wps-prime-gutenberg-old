<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since Child Theme 1.0
 */

add_action( 'customize_register', array( 'WPS_Prime_Customize_Footer_Setup', 'register' ) );
class WPS_Prime_Customize_Footer_Setup {


	public static function register( $wp_customize ) {

		/******************************
		 * Sections
		*/
		$wp_customize->add_section(
			'footer_setup_section',
			array(
				'title'      => __( 'Footer Setup', 'wps-prime' ),
				'priority'   => 2,
				'capability' => 'edit_theme_options',

			)
		);

		/******************************
		* SETTING|CONTROL PAIRS FOOTER COLORS
		* 2. Register new settings to the WP database...
		* 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
	   */

		// SETTING
		$wp_customize->add_setting(
			'wps_footer_text_color',
			array(
				'default'    => '#ffffff',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		 // CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_footer_text_color',
				array(
					'label'       => __( 'Footer text color', 'wps-prime' ),
					'description' => __( '', 'wps-prime' ),
					'settings'    => 'wps_footer_text_color',
					'priority'    => 10,
					'section'     => 'footer_setup_section',
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_footer_heading_color',
			array(
				'default'    => '#ffffff',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		 // CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_footer_heading_color',
				array(
					'label'       => __( 'Footer headings color', 'wps-prime' ),
					'description' => __( '', 'wps-prime' ),
					'settings'    => 'wps_footer_heading_color',
					'priority'    => 10,
					'section'     => 'footer_setup_section',
				)
			)
		);

				// SETTING
				$wp_customize->add_setting(
					'wps_footer_link_color',
					array(
						'default'    => '#ffffff',
						'type'       => 'theme_mod',
						'capability' => 'edit_theme_options',
						'transport'  => 'postMessage',
					)
				);

				 // CONTROL
				$wp_customize->add_control(
					new WP_Customize_Color_Control(
						$wp_customize,
						'wps_theme_footer_link_color',
						array(
							'label'       => __( 'Footer link color', 'wps-prime' ),
							'description' => __( '', 'wps-prime' ),
							'settings'    => 'wps_footer_link_color',
							'priority'    => 10,
							'section'     => 'footer_setup_section',
						)
					)
				);

		// SETTING
		$wp_customize->add_setting(
			'wps_footer_background_color',
			array(
				'default'    => '#000000',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		 // CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_footer_background_color',
				array(
					'label'       => __( 'Footer background color', 'wps-prime' ),
					'description' => __( '', 'wps-prime' ),
					'settings'    => 'wps_footer_background_color',
					'priority'    => 10,
					'section'     => 'footer_setup_section',
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_footer_micro_background_color',
			array(
				'default'    => '#333333',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		 // CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_footer_micro_background_color',
				array(
					'label'       => __( 'Footer microcopy background ', 'wps-prime' ),
					'description' => __( '', 'wps-prime' ),
					'settings'    => 'wps_footer_micro_background_color',
					'priority'    => 10,
					'section'     => 'footer_setup_section',
				)
			)
		);

		$wp_customize->add_setting(
			'use_custom_footer',
			array(
				'default'    => false,
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'refresh',
			)
		);

		$wp_customize->add_control(
			'use_custom_footer',
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Use custom footer', 'wps-prime' ),
				'description' => __( 'This will disable the default footer and will use the custom footer content', 'wps-prime' ),
				'priority'    => 10,
				'section'     => 'footer_setup_section',
			)
		);

		$wp_customize->add_setting(
			'hide_footer_micro',
			array(
				'default'    => false,
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'refresh',
			)
		);

		$wp_customize->add_control(
			'hide_footer_micro',
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Remove footer microcopy', 'wps-prime' ),
				'description' => __( 'Remove the info text under the footer', 'wps-prime' ),
				'priority'    => 10,
				'section'     => 'footer_setup_section',
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'footer_custom_content',
			array(
				'default'    => '',
				'type'       => 'option',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'footer_custom_content', // Set a unique ID for the control
			array(
				'type'        => 'textarea',
				'label'       => __( 'Footer custom content', 'wps-prime' ),
				'description' => __( 'Create a custom footer', 'wps-prime' ),
				'priority'    => 10,
				'section'     => 'footer_setup_section',
			)
		);
	}

}
