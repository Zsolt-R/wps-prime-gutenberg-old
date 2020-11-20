<?php
add_action( 'customize_register', array( 'WPS_Prime_Customize_Typography', 'register' ) );
class WPS_Prime_Customize_Typography {

	private static function get_font_weights() {

		$weights = array(
			'100' => 100,
			'200' => 200,
			'300' => 300,
			'400' => 400,
			'500' => 500,
			'600' => 600,
			'700' => 700,
			'800' => 800,
			'900' => 900,
		);

		return $weights;
	}


	public static function register( $wp_customize ) {

		$fonts = new WpsGetThemeFonts();

		$wp_customize->add_panel(
			'typography_panel',
			array(
				'priority'       => 10,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => 'Typography',
				'description'    => '',
			)
		);

		$wp_customize->add_section(
			'font_setup_section',
			array(
				'title'      => __( 'Fonts setup', 'wps-prime' ), // Visible title of section
				'priority'   => 35, // Determines what order this appears in
				'capability' => 'edit_theme_options', // Capability needed to tweak
				'panel'      => 'typography_panel',
			)
		);

		/******************************
		 * SETTING|CONTROL PAIRS TYPOGRAPY
		 * 2. Register new settings to the WP database...
		 * 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		*/
		// SETTING
		$wp_customize->add_setting(
			'wps_custom_font_family_status', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_custom_font_family_status', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Disable google fonts.', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Provide your custom font instead', 'wps-prime' ),

				'section'     => 'font_setup_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_main_font_family', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => false, // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_main_font_family', // Set a unique ID for the control
			array(
				'type'        => 'select',
				'label'       => __( 'Body Font', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Choose what font family to use as the main Body font.', 'wps-prime' ),

				'section'     => 'font_setup_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'choices'     => array_merge( array( 'empty' => 'Choose font family' ), ( $fonts->get_fonts_name() ) ),
				'default'     => 'empty',
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_main_font_weight', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => 400, // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_main_font_weight', // Set a unique ID for the control
			array(
				'type'        => 'select',
				'label'       => __( 'Body font weight', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Font weight availability vary for each font', 'wps-prime' ),
				'section'     => 'font_setup_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'choices'     => self::get_font_weights(),
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_font_family_subset', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => false, // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_second_font_family_status', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => false, // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_second_font_family_status', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Heading Font Status', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Set different font family for headings.  This option has performance impact." css class on a text.', 'wps-prime' ),

				'section'     => 'font_setup_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_secondary_font_family', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => false, // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_secondary_font_family', // Set a unique ID for the control
			array(
				'type'        => 'select',
				'label'       => __( 'Heading Font', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Choose what font family to use as the main Heading font.', 'wps-prime' ),

				'section'     => 'font_setup_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'choices'     => array_merge( array( 'empty' => 'Choose font family' ), ( $fonts->get_fonts_name() ) ),
				'default'     => 'empty',
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_second_font_weight', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => 600, // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_second_font_weight', // Set a unique ID for the control
			array(
				'type'        => 'select',
				'label'       => __( 'Heading font weight', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Font weight availability vary for each font', 'wps-prime' ),
				'section'     => 'font_setup_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'choices'     => self::get_font_weights(),
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_nav_custom_font', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => false, // Default setting/value to save
				'type'       => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_nav_custom_font', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Navigation Font', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Set heading font family for navigation.', 'wps-prime' ),

				'section'     => 'font_setup_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);
	}
}
