<?php
add_action( 'customize_register', array( 'WPS_Prime_Customize_Site_Content', 'register' ) );
class WPS_Prime_Customize_Site_Content {

	private static function get_pages() {
		// Pull all the pages into an array
		$options_pages     = array();
		$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
		$options_pages[''] = 'Select a page:';
		foreach ( $options_pages_obj as $page ) {
			$options_pages[ $page->ID ] = $page->post_title;
		}
		return $options_pages;
	}

	public static function register( $wp_customize ) {
		$wp_customize->add_panel(
			'theme_site_content_panel',
			array(
				'priority'       => 10,
				'capability'     => 'edit_theme_options',
				'theme_supports' => '',
				'title'          => 'Site content',
				'description'    => '',
			)
		);

		$wp_customize->add_section(
			'site_content_section',
			array(
				'title'       => __( 'Site content', 'wps-prime' ), // Visible title of section
				'priority'    => 35, // Determines what order this appears in
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( '', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'theme_site_content_panel',
			)
		);
		$wp_customize->add_section(
			'site_blog_section',
			array(
				'title'       => __( 'Blog', 'wps-prime' ), // Visible title of section
				'priority'    => 35, // Determines what order this appears in
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( '', 'wps-prime' ), // Descriptive tooltip
				'panel'       => 'theme_site_content_panel',
			)
		);

		/******************************
			 * SETTING|CONTROL PAIRS Site content
			 * 2. Register new settings to the WP database...
			 * 3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
			*/
		// SETTING
		$wp_customize->add_setting(
			'wps_global_content_start_area', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_global_content_start_area', // Set a unique ID for the control
			array(
				'type'        => 'textarea',
				'label'       => __( 'Global before header content', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Area visible at the start of the site. ( default location before the header )', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'site_content_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		$wp_customize->add_setting(
			'wps_global_after_header_area', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_global_after_header_area', // Set a unique ID for the control
			array(
				'type'        => 'textarea',
				'label'       => __( 'Global after header', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Area visible after header just before the main content.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'site_content_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		$wp_customize->add_setting(
			'wps_global_main_content_start_area', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_global_main_content_start_area', // Set a unique ID for the control
			array(
				'type'        => 'textarea',
				'label'       => __( 'Global before main content', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Area visible at the start of the main content right after the header.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'site_content_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_global_content_end_area', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_global_content_end_area', // Set a unique ID for the control
			array(
				'type'        => 'textarea',
				'label'       => __( 'Global before footer content', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Area visible on all the site pages. ( default location before the footer )', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'site_content_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_theme_widget_class', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => false, // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_theme_widget_class', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Widget custom CSS class', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Enable custom CSS field option on site widgets', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'site_content_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_404_custom_page', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => false, // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_404_custom_page', // Set a unique ID for the control
			array(
				'type'        => 'select',
				'label'       => __( 'Choose a page to use it as 404', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Choose a page to display it\'s content on the 404 error page.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'site_content_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'choices'     => self::get_pages(),
			)
		);

		// SETTING
		$wp_customize->add_setting(
			'wps_article_meta_visibility', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => false, // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_article_meta_visibility', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Hide article meta', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Set Article meta data visibility (ex. Posted on... / Posted in ...) show/hide. Default \'show\'', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'site_blog_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);

			// SETTING
			$wp_customize->add_setting(
				'wps_meta_u_time_visibility', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array(
					'default'    => false, // Default setting/value to save
					'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
					'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
					'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				)
			);

			// CONTROL
			$wp_customize->add_control(
				'wps_meta_u_time_visibility', // Set a unique ID for the control
				array(
					'type'        => 'checkbox',
					'label'       => __( 'Article meta time setting', 'wps-prime' ), // Admin-visible name of the control
					'description' => __( 'Show modified time and publish time', 'wps-prime' ),
					'priority'    => 10, // Determines the order this control appears in for the specified section
					'section'     => 'site_blog_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				)
			);

		// SETTING
		$wp_customize->add_setting(
			'wps_disable_comment_url', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'    => '', // Default setting/value to save
				'type'       => 'option', // Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', // Optional. Special permissions for accessing this setting.
				'transport'  => 'refresh', // What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			)
		);

		// CONTROL
		$wp_customize->add_control(
			'wps_disable_comment_url', // Set a unique ID for the control
			array(
				'type'        => 'checkbox',
				'label'       => __( 'Comment form URL field', 'wps-prime' ), // Admin-visible name of the control
				'description' => __( 'Disable the url field in the comment form section.', 'wps-prime' ),
				'priority'    => 10, // Determines the order this control appears in for the specified section
				'section'     => 'site_blog_section', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
			)
		);
		$wp_customize->get_setting( 'wps_global_content_start_area' )->transport = 'postMessage';
		$wp_customize->get_setting( 'wps_global_content_end_area' )->transport   = 'postMessage';

		$wp_customize->get_setting( 'wps_article_meta_visibility' )->transport = 'refresh';
		$wp_customize->get_setting( 'wps_meta_u_time_visibility' )->transport  = 'refresh';

		$wp_customize->selective_refresh->add_partial(
			'wps_global_content_end_area',
			array(
				'selector'        => '.site-global-content-end',
				'render_callback' => 'wps_theme_global_content_end_area',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'wps_global_content_end_area',
			array(
				'selector'        => '.site-global-content-start',
				'render_callback' => 'wps_theme_global_content_start_area',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'wps_article_meta_visibility',
			array(
				'selector'        => '.entry-meta-content',
				'render_callback' => 'wps_prime_posted_on',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'wps_meta_u_time_visibility',
			array(
				'selector'        => '.entry-date',
				'render_callback' => 'wps_prime_posted_on_time',
			)
		);

	}

}
