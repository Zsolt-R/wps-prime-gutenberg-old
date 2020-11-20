<?php

add_action( 'customize_register', array( 'WPS_Prime_Customize_Dev_Tweaks', 'register' ) );
class WPS_Prime_Customize_Dev_Tweaks {
	public static function register( $wp_customize ) {

		$dev_info  = '<p>';
		$dev_info .= WPS_Prime_Tools::get_development_data() . '<br>';
		$dev_info .= '<span style="font-size:22px;font-weight:300;">Available image sizes:</span><br><br>';
		$dev_info .= WPS_Prime_Tools::get_image_sizes();
		$dev_info .= '</p>';

		$wp_customize->add_panel(
			'developer_tweaks_section',
			array(
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => 'Developer Tweaks',
			)
		);

		$wp_customize->add_section(
			'performance_tweaks_section',
			array(
				'title'      => __( 'Performance Tweaks', 'wps-prime' ), // Visible title of section
				'priority'   => 35, // Determines what order this appears in
				'capability' => 'edit_theme_options', // Capability needed to tweak
				'panel'      => 'developer_tweaks_section',
			)
		);

		$wp_customize->add_section(
			'developer_info_section',
			array(
				'title'              => __( 'System Status / Dev. options', 'wps-prime' ), // Visible title of section
				'priority'           => 200, // Determines what order this appears in
				'capability'         => 'edit_theme_options', // Capability needed to tweak
				'panel'              => 'developer_tweaks_section',
				'description_hidden' => false,
				'description'        => $dev_info,
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_remove_assets_version_numbers', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_remove_assets_version_numbers', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Asset version number', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Remove asset number. Optimize website score by removing version number of scripts and styles. (You will need to hard refresh / clear cache when assets are updated)', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'performance_tweaks_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_front_emoji_use', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_front_emoji_use', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'WordPress default emoji', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Disable unused empji scripts from loading on front end.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'performance_tweaks_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_front_dashicons_use', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_front_dashicons_use', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'WordPress default dashicons', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Disable unused dashicon scripts from loading on front end.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'performance_tweaks_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_front_jquery_migrate_use', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_front_jquery_migrate_use', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'jQuery migrate', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Disable jQuery migrate from loading on front end.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'performance_tweaks_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_disable_animation_lib', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_disable_animation_lib', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Animation CCS library', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Disable animation css library', 'wps-prime' ) . ' -> <a href="https://daneden.github.io/animate.css/" target="_blank" title="Open in new window">link</a>',
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'performance_tweaks_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_display_wps_hooks', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_display_wps_hooks', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Display WPS hooks on front end', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Show WPS Prime hooks on front end. Usefull for debugging and theme development', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'developer_info_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		$wp_customize->get_setting( 'wps_display_wps_hooks' )->transport = 'refresh';

	}
}
