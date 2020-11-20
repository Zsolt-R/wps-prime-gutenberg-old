<?php

add_action( 'customize_register', array( 'WPS_Prime_Customize_Site_Branding', 'register' ) );
class WPS_Prime_Customize_Site_Branding {
	public static function register( $wp_customize ) {

		$wp_customize->add_panel(
			'theme_branding_panel',
			array(
				'priority'       => 10,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => 'Branding',
				'description'    => '',
			)
		);

		/******************************
		 * SECTIONS
		 * 1. Define a new section (if desired) to the Theme Customizer
		*/

		$wp_customize->add_section(
			'company_details_section',
			array(
				'title'       => __( 'Company details', 'wps-prime' ), // Visible title of section
				'priority'    => 35, // Determines what order this appears in
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( 'Details here are used all over the website', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'theme_branding_panel',
			)
		);

		$wp_customize->add_section(
			'company_social_media_section',
			array(
				'title'       => __( 'Social Media', 'wps-prime' ), // Visible title of section
				'priority'    => 35, // Determines what order this appears in
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( '', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'theme_branding_panel',
			)
		);

		/******************************
		 * SETTING|SITE BRANDING
		 * 2. Register new settings to the WP database...
		 * 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		*/
		// SETTING
		$wp_customize->add_setting(
			'wps_branding_company_logo', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			new WP_Customize_Upload_Control(
				$wp_customize,
				'branding_company_logo',
				array(
					'label'       => __( 'Company logo', 'wps-prime' ), // Admin-visible name of the control
					'description' => __( 'Logo will be rendered at full size. Please adjust your logo size to the correct fit. The logo will replace sitename/company name in the header area', 'wps-prime' ),
					'section'     => 'company_details_section',
					'settings'    => 'wps_branding_company_logo',
				)
			)
		);
		// SETTING
		$wp_customize->add_setting(
			'wps_phone_nr', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_phone_nr', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Company phone number', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Used in a shortcode. Regardles where the phone number will be placed you can update it from here', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_details_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_phone_nr_second', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_phone_nr_second', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Company phone number Second', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Used in a shortcode. Regardles where the phone number will be placed you can update it from here', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_details_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_email_address', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_email_address', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Company contact email', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Used in a shortcode. Regardles where the email will be placed you can update it from here', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_details_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_email_address_second', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_email_address_second', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Company contact email Second', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Used in a shortcode. Regardles where the email will be placed you can update it from here', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_details_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_site_disclaimer', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'postMessage', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_site_disclaimer', // Set a unique ID for the control
			array(
				'type'        => 'textarea',
				'label'       => __( 'Site disclaimer', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Disclaimer text will appear in the footer.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_details_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		/******************************
		 * SETTING|CONTROL PAIRS Social Media
		 * 2. Register new settings to the WP database...
		 * 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		*/
		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_facebook', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_facebook', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Facebook link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_instagram', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_instagram', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Instagram link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_twitter', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_twitter', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Twitter link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_linkedin', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_linkedin', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'LinkedIn link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_gbusiness', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		  // CONTROL
		$wp_customize->add_control(
			'wps_social_link_gbusiness', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Google my business link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_youtube', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_youtube', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Youtube link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_vimeo', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_vimeo', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Vimeo link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_flickr', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_flickr', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Flickr link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_pinterest', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_pinterest', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Pinterest link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_social_link_medium', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_social_link_medium', // Set a unique ID for the control
			array(
				'type'        => 'text',
				'label'       => __( 'Medium link', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( '', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'company_social_media_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// 4. We can also change built-in settings by modifying properties. 
		// For instance, let's make some stuff use live preview JS...
		$wp_customize->get_setting( 'blogname' )->transport                      = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport               = 'postMessage';
		

		$wp_customize->get_setting( 'wps_branding_company_logo' )->transport = 'postMessage';
		$wp_customize->get_setting( 'wps_site_disclaimer' )->transport       = 'postMessage';

		$wp_customize->selective_refresh->add_partial(
			'wps_branding_company_logo',
			array(
				'selector'        => '.site-branding-logo',
				'render_callback' => 'wps_site_branding_logo',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'wps_site_disclaimer',
			array(
				'selector'        => '.site-disclaimer',
				'render_callback' => 'wps_site_disclaimer',
			)
		);

	}
}
