<?php

function wps_prime_sanitize_select( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

add_action( 'customize_register', array( 'WPS_Prime_Customize_Header_Setup', 'register' ) );
class WPS_Prime_Customize_Header_Setup {


	public static function register( $wp_customize ) {

		$wp_customize->add_panel(
			'header_setup',
			array(
				'priority'       => 1,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => 'Header setup',
				'description'    => '',
			)
		);

		$wp_customize->add_section(
			'wps_header_setup_settings',
			array(
				'title'       => __( 'Settings', 'wps-prime' ), // Visible title of section
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( '', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'header_setup',
			)
		);

		$wp_customize->add_section(
			'wps_header_color_settings',
			array(
				'title'       => __( 'Colors', 'wps-prime' ), // Visible title of section
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( '', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'header_setup',
			)
		);

		/**
		 * Start settings
		 */

		$wp_customize->add_setting(
			'main_menu_type',
			array(
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'wps_prime_sanitize_select',
				'type'              => 'theme_mod',
				'default'           => 'menu_type_1',
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			'main_menu_type',
			array(
				'type'        => 'select',
				'section'     => 'wps_header_setup_settings',
				'label'       => __( 'Select menu location', 'wps-prime' ),
				'description' => __( 'Under header menu has Menu mega capability', 'wps-prime' ),
				'choices'     => array(
					'menu_type_1' => __( 'Menu in header' ),
					'menu_type_2' => __( 'Menu under header' ),
				),
			)
		);

		/**
		 * Settings
		*/

		$wp_customize->add_setting(
			'header_show_phone',
			array(
				'default'    => false,
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'refresh',
			)
		);

		$wp_customize->add_control(
			'header_show_phone',
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Phone number visibility', 'wps-prime' ),
				'description' => __( 'Show', 'wps-prime' ),
				'priority'    => 10,
				'section'     => 'wps_header_setup_settings',
			)
		);

		/**
		 * Settings
		*/

		$wp_customize->add_setting(
			'header_show_email',
			array(
				'default'    => false,
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'refresh',
			)
		);

		$wp_customize->add_control(
			'header_show_email',
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Email visibility', 'wps-prime' ),
				'description' => __( 'Show', 'wps-prime' ),
				'priority'    => 10,
				'section'     => 'wps_header_setup_settings',
			)
		);

		/**
		 * Settings
		*/
		$wp_customize->add_setting(
			'header_contact_show_labels',
			array(
				'default'    => false,
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'refresh',
			)
		);

		$wp_customize->add_control(
			'header_contact_show_labels',
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Show email/phone text', 'wps-prime' ),
				'description' => __( 'Show contact data with the number and email text', 'wps-prime' ),
				'priority'    => 10,
				'section'     => 'wps_header_setup_settings',
			)
		);

		/**
		 * Settings
		*/

		$wp_customize->add_setting(
			'header_utility_show_contact',
			array(
				'default'    => false,
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'refresh',
			)
		);

		$wp_customize->add_control(
			'header_utility_show_contact',
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Social media icons', 'wps-prime' ),
				'description' => __( 'Show social media icons near the phone and email', 'wps-prime' ),
				'priority'    => 10,
				'section'     => 'wps_header_setup_settings',
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'header_utility_content',
			array(
				'default'    => '',
				'type'       => 'option',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

				// CONTROL
		$wp_customize->add_control(
			'header_utility_content', // Set a unique ID for the control
			array(
				'type'        => 'textarea',
				'label'       => __( 'Header content', 'wps-prime' ),
				'description' => __( 'Area visible in the header area', 'wps-prime' ),
				'priority'    => 10,
				'section'     => 'wps_header_setup_settings',
			)
		);

		/**
		 * Settings
		*/

		$wp_customize->add_setting(
			'header_use_sticky',
			array(
				'default'    => false,
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'refresh',
			)
		);

		$wp_customize->add_control(
			'header_use_sticky',
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Use sticky header', 'wps-prime' ),
				'description' => __( 'Make the header scroll with the page', 'wps-prime' ),
				'priority'    => 10,
				'section'     => 'wps_header_setup_settings',
			)
		);

		/**
		 * Settings
		*/

		$wp_customize->add_setting(
			'wps_mega_menu_background', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '#bbbbbb', // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_mega_menu_background', // Set a unique ID for the control
				array(
					'label'       => __( 'Menu bar background color', 'wps-prime' ), // Admin-visible name of the control
					'description' => __( 'Background color when menu is under the header', 'wps-prime' ), // Descriptive tooltip
					'settings'    => 'wps_mega_menu_background', // Which setting to load and manipulate (serialized is okay)
					'priority'    => 10, // Determines the order this control appears in for the specified section
					'section'     => 'wps_header_color_settings', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		/**
		 * Settings
		*/

		$wp_customize->add_setting(
			'wps_header_background', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '#ffffff', // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_header_background', // Set a unique ID for the control
				array(
					'label'       => __( 'Header background color', 'wps-prime' ), // Admin-visible name of the control
					'description' => __( '', 'wps-prime' ), // Descriptive tooltip
					'settings'    => 'wps_header_background', // Which setting to load and manipulate (serialized is okay)
					'priority'    => 10, // Determines the order this control appears in for the specified section
					'section'     => 'wps_header_color_settings', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		/**
		 * Settings
		*/

		$wp_customize->add_setting(
			'wps_header_background_sticky', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '#000000', // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control( // Instantiate the color control class
				$wp_customize, // Pass the $wp_customize object (required)
				'wps_theme_header_background_sticky', // Set a unique ID for the control
				array(
					'label'       => __( 'Main header sticky background color', 'wps-prime' ), // Admin-visible name of the control
					'description' => __( '', 'wps-prime' ), // Descriptive tooltip
					'settings'    => 'wps_header_background_sticky', // Which setting to load and manipulate (serialized is okay)
					'priority'    => 10, // Determines the order this control appears in for the specified section
					'section'     => 'wps_header_color_settings', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			)
		);

		/**
		 * Settings
		*/
		$wp_customize->add_setting(
			'wps_header_background_sticky_opacity', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '0.8', // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		$wp_customize->add_control(
			'wps_theme_header_background_sticky_opacity', // Set a unique ID for the control
			array(
				'type'              => 'range',
				'label'             => __( 'Sticky background opacity', 'wps-prime' ), // Admin-visible name of the control
				'description'       => __( 'Use the slider to set the opacity, between 0 and 1 values. 0.1 steps (0.1 = 10%)', 'wps-prime' ),
				'priority'          => 10, // Determines the order this control appears in for the specified section
				'section'           => 'wps_header_color_settings', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'input_attrs'       => array(
					'min'  => 0,
					'max'  => 1,
					'step' => 0.1,
				),
				'sanitize_callback' => 'intval',
				'settings'          => 'wps_header_background_sticky_opacity',
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_main_nav_sticky_text_color',
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
				'wps_theme_main_nav_sticky_text_color',
				array(
					'label'       => __( 'Main navigation text color when sticky', 'wps-prime' ),
					'description' => __( '', 'wps-prime' ),
					'settings'    => 'wps_main_nav_sticky_text_color',
					'priority'    => 10,
					'section'     => 'wps_header_color_settings',
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_main_nav_text_color',
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
				'wps_theme_main_nav_color',
				array(
					'label'       => __( 'Main navigation text color', 'wps-prime' ),
					'description' => __( '', 'wps-prime' ),
					'settings'    => 'wps_main_nav_text_color',
					'priority'    => 10,
					'section'     => 'wps_header_color_settings',
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_main_nav_text_color_h',
			array(
				'default'    => '#209bed',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		 // CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_main_nav_color_h',
				array(
					'label'       => __( 'Main navigation hover text color', 'wps-prime' ),
					'description' => __( '', 'wps-prime' ),
					'settings'    => 'wps_main_nav_text_color_h',
					'priority'    => 10,
					'section'     => 'wps_header_color_settings',
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_main_nav_text_color_active',
			array(
				'default'    => '#209bed',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		 // CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_main_nav_color_active',
				array(
					'label'       => __( 'Main navigation active color', 'wps-prime' ),
					'description' => __( '', 'wps-prime' ),
					'settings'    => 'wps_main_nav_text_color_active',
					'priority'    => 10,
					'section'     => 'wps_header_color_settings',
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_main_nav_ca_one_color',
			array(
				'default'    => '#309bd4',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		 // CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_main_nav_ca_one_color',
				array(
					'label'       => __( 'Main navigation first call to action color', 'wps-prime' ),
					'description' => __( '', 'wps-prime' ),
					'settings'    => 'wps_main_nav_ca_one_color',
					'priority'    => 10,
					'section'     => 'wps_header_color_settings',
				)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_main_nav_ca_two_color',
			array(
				'default'    => '#e74c3c',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		 // CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_main_nav_ca_two_color',
				array(
					'label'       => __( 'Main navigation second call to action color', 'wps-prime' ),
					'description' => __( '', 'wps-prime' ),
					'settings'    => 'wps_main_nav_ca_two_color',
					'priority'    => 10,
					'section'     => 'wps_header_color_settings',
				)
			)
		);

				// SETTING
				$wp_customize->add_setting(
					'wps_main_nav_ca_text_color',
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
						'wps_theme_main_nav_ca_text_color',
						array(
							'label'       => __( 'Call to action button text color', 'wps-prime' ),
							'description' => __( '', 'wps-prime' ),
							'settings'    => 'wps_main_nav_ca_text_color',
							'priority'    => 10,
							'section'     => 'wps_header_color_settings',
						)
					)
				);

				// SETTING
				$wp_customize->add_setting(
					'wps_main_nav_submenu_text_color',
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
						'wps_theme_main_nav_submenu_text_color',
						array(
							'label'       => __( 'Submenu text color', 'wps-prime' ),
							'description' => __( '', 'wps-prime' ),
							'settings'    => 'wps_main_nav_submenu_text_color',
							'priority'    => 10,
							'section'     => 'wps_header_color_settings',
						)
					)
				);

				// SETTING
				$wp_customize->add_setting(
					'wps_main_nav_submenu_text_color_h',
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
						'wps_theme_main_nav_submenu_text_color_h',
						array(
							'label'       => __( 'Submenu hover text color', 'wps-prime' ),
							'description' => __( '', 'wps-prime' ),
							'settings'    => 'wps_main_nav_submenu_text_color_h',
							'priority'    => 10,
							'section'     => 'wps_header_color_settings',
						)
					)
				);

				// SETTING
		$wp_customize->add_setting(
			'wps_main_nav_submenu_text_color_active',
			array(
				'default'    => '#209bed',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		 // CONTROL
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wps_theme_main_nav_submenu_text_color_active',
				array(
					'label'       => __( 'Submenu active text color', 'wps-prime' ),
					'description' => __( '', 'wps-prime' ),
					'settings'    => 'wps_main_nav_submenu_text_color_active',
					'priority'    => 10,
					'section'     => 'wps_header_color_settings',
				)
			)
		);

				// SETTING
				$wp_customize->add_setting(
					'wps_main_submenu_background',
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
						'wps_theme_main_submenu_background',
						array(
							'label'       => __( 'Submenu background color', 'wps-prime' ),
							'description' => __( '', 'wps-prime' ),
							'settings'    => 'wps_main_submenu_background',
							'priority'    => 10,
							'section'     => 'wps_header_color_settings',
						)
					)
				);
				// SETTING
				$wp_customize->add_setting(
					'wps_main_nav_utility_color',
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
						'wps_theme_nav_utility_color',
						array(
							'label'       => __( 'Main nav utility color', 'wps-prime' ),
							'description' => __( '', 'wps-prime' ),
							'settings'    => 'wps_main_nav_utility_color',
							'priority'    => 10,
							'section'     => 'wps_header_color_settings',
						)
					)
				);

				// SETTING
				$wp_customize->add_setting(
					'wps_main_nav_utility_color_h',
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
						'wps_theme_nav_utility_color_h',
						array(
							'label'       => __( 'Main nav utility color hover', 'wps-prime' ),
							'description' => __( '', 'wps-prime' ),
							'settings'    => 'wps_main_nav_utility_color_h',
							'priority'    => 10,
							'section'     => 'wps_header_color_settings',
						)
					)
				);

				// SETTING
				$wp_customize->add_setting(
					'wps_main_side_nav_text_color',
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
						'wps_theme_main_side_nav_color',
						array(
							'label'       => __( 'Main mobile navigation text color', 'wps-prime' ),
							'description' => __( '', 'wps-prime' ),
							'settings'    => 'wps_main_side_nav_text_color',
							'priority'    => 10,
							'section'     => 'wps_header_color_settings',
						)
					)
				);

				// SETTING
				$wp_customize->add_setting(
					'wps_main_side_nav_background_color',
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
						'wps_theme_main_side_nav_background_color',
						array(
							'label'       => __( 'Main mobile navigation background color', 'wps-prime' ),
							'description' => __( '', 'wps-prime' ),
							'settings'    => 'wps_main_side_nav_background_color',
							'priority'    => 10,
							'section'     => 'wps_header_color_settings',
						)
					)
				);

				/**
				 * Add customizer edit bubbles
				 */
				$wp_customize->selective_refresh->add_partial(
					'main_menu_type',
					array(
						'selector' => '.site-nav__menu-container',
					)
				);

				$wp_customize->selective_refresh->add_partial(
					'header_show_phone',
					array(
						'selector' => '.head-utility',
					)
				);

	}
};
