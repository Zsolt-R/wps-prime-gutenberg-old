<?php
/**
 * WPS Prime Gutenberg functions and definitions.
 *
 * @see https://developer.wordpress.org/themes/basics/theme-functions/
 */

/***************************************
	# DEFINE CONSTANTS
 ****************************************/


class WPS_Prime_Init {


	/**
	 * Main Theme Class Constructor.
	 *
	 * Loads all necessary classes, functions, hooks, configuration files and actions for the theme.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->theme_constants();

		add_action( 'init', array( $this, 'theme_customizer' ), 9 );

		/* Register theme default setup */
		add_action( 'init', array( $this, 'setup_defaults' ), 1 );

		add_action( 'after_setup_theme', array( $this, 'theme_woocommerce' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'theme_js' ) );

		/* Enqueue main style. */
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_css' ) );

		add_action( 'enqueue_block_editor_assets', array( $this, 'editor_assets_enqueue' ) );

		/* Enque gutenberg post meta fields */
		add_action( 'init', array( $this, 'post_meta' ) );

		/* Theme Content width */
		add_action( 'after_setup_theme', array( $this, 'content_width' ), 0 );

		/* Load theme helpers */
		add_action( 'after_setup_theme', array( $this, 'theme_helpers' ), 1 );

		/* Load theme typography generator */
		add_action( 'after_setup_theme', array( $this, 'theme_typography' ), 2 );

		/* Load base functions */
		add_action( 'after_setup_theme', array( $this, 'theme_base' ) );

		/*
		 * Load configuration
		 * Must load first so it can use hooks defined in the classes
		 */
		add_action( 'after_setup_theme', array( $this, 'theme_settings' ), 4 );

		/* Load meta boxes */
		add_action( 'after_setup_theme', array( $this, 'theme_meta_boxes' ), 5 );

		/* Register sidebar widget areas */
		add_action( 'widgets_init', array( $this, 'theme_sidebars' ) );

		/* Load Theme Custom Components (Index custom components/objects ) */
		add_action( 'after_setup_theme', array( $this, 'theme_components' ) );

		add_action( 'after_setup_theme', array( $this, 'theme_front_end_layout_setup' ) );
	}

	/**
	 * Define constants.
	 *
	 * @since 1.0.0
	 */
	public function theme_constants() {
		define( 'THEME_DIR', get_template_directory() );
		define( 'THEME_URI', get_template_directory_uri() );
		define( 'WPS_PRIME_THEME_VERSION', '3.0.0' );
		define( 'WPS_OPTIONS_PREFIX', 'wps' );
	}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
	public function setup_defaults() {
		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on wps_prime, use a find and replace
		* to change 'wps-prime' to the name of your theme in all the template files
		*/
		load_theme_textdomain( 'wps-prime-g', get_template_directory() . '/languages' );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

		/* Add default posts and comments RSS feed links to head. */
		add_theme_support( 'automatic-feed-links' );

		/* Enable support for Post Thumbnails */
		add_theme_support( 'post-thumbnails' );

		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/* 3rd Party plugins support */
		add_theme_support( 'woocommerce' );
		add_theme_support( 'yoast-seo-breadcrumbs' );

		/**
		 * Gutenberg settings
		 *
		 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
		 */
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );

		/**
		 * @link https://flatuicolors.com/palette/cn
		 */

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Color one', 'wps-prime' ),
					'slug'  => 'color-one',
					'color' => '#1e90ff',
				),
				array(
					'name'  => __( 'Color two', 'wps-prime' ),
					'slug'  => 'color-two',
					'color' => '#ff6348',
				),
				array(
					'name'  => __( 'Color three', 'wps-prime' ),
					'slug'  => 'color-three',
					'color' => '#ff4757',
				),
				array(
					'name'  => __( 'Color four', 'wps-prime' ),
					'slug'  => 'color-four',
					'color' => '#ffa502',
				),
				array(
					'name'  => __( 'Color five', 'wps-prime' ),
					'slug'  => 'color-five',
					'color' => '#2ed573',
				),
				array(
					'name'  => __( 'Color six', 'wps-prime' ),
					'slug'  => 'color-six',
					'color' => '#eccc68',
				),
				array(
					'name'  => __( 'Color body', 'wps-prime' ),
					'slug'  => 'color-body',
					'color' => '#ffffff',
				),
				array(
					'name'  => __( 'Color light', 'wps-prime' ),
					'slug'  => 'color-light',
					'color' => '#f1f2f6',
				),
				array(
					'name'  => __( 'Color dark', 'wps-prime' ),
					'slug'  => 'color-dark',
					'color' => '#2f3542',
				),
				array(
					'name'  => __( 'Color transparent light', 'wps-prime' ),
					'slug'  => 'color-transparent-light',
					'color' => '#fEfEfE',
				),
				array(
					'name'  => __( 'Color transparent dark', 'wps-prime' ),
					'slug'  => 'color-transparent-dark',
					'color' => '#000000',
				),
			)
		);

		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name' => __( 'Small', 'wps-prime' ),
					'size' => 12,
					'slug' => 'small',
				),
				array(
					'name' => __( 'Regular', 'wps-prime' ),
					'size' => 16,
					'slug' => 'regular',
				),
				array(
					'name' => __( 'Large', 'wps-prime' ),
					'size' => 36,
					'slug' => 'large',
				),
				array(
					'name' => __( 'Huge', 'wps-prime' ),
					'size' => 50,
					'slug' => 'huge',
				),
			)
		);

		// add_theme_support( 'custom-units', 'rem', 'em' );
		remove_theme_support( 'core-block-patterns' );
		add_theme_support( 'align-wide' );

		// Disable ability to set custom
		add_theme_support( 'disable-custom-font-sizes' );
		// add_theme_support( 'disable-custom-colors' );
		add_theme_support( 'disable-custom-gradients' );

		// Dark backgrounds
		add_theme_support( 'editor-styles' );
		// add_theme_support( 'dark-editor-style' );

		// Add cujstom editor style
		// add_editor_style( 'style-editor-dark.css' );

		// add_theme_support( 'experimental-custom-spacing' );
	}

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	public function content_width() {
		$GLOBALS['content_width'] = apply_filters( 'wps_prime_content_width', 1152 );
	}

	/**
	 * Theme helpers.
	 *
	 * @since 1.0.0
	 */
	public function theme_helpers() {
		/* Admin Settings Page */
		include_once THEME_DIR . '/inc/theme-helpers/tools.class.php';
		include_once THEME_DIR . '/inc/theme-helpers/icons.class.php';
	}

	public function post_meta() {
		/**
		 * Make meta avaliable in rest data
		 *
		 * @link https://developer.wordpress.org/reference/functions/register_post_meta/
		 */

		$field_ids = array(
			'_wps_prime_hide_title',
			'_wps_prime_page_margin_top_reset',
			'_wps_prime_page_margin_bottom_reset',
			'_wps_prime_hide_footer',
		);

		foreach ( $field_ids as $field_id ) {
			register_post_meta(
				'page',
				$field_id,
				array(
					'show_in_rest'  => true,
					'single'        => true,
					'type'          => 'boolean',
					'default'       => false,
					'auth_callback' => function() {
						return current_user_can( 'edit_posts' );
					},
				)
			);
		}
	}
	public function editor_assets_enqueue() {
		wp_enqueue_script(
			'wps-prime-theme-post-meta',
			get_template_directory_uri() . '/assets/gutenberg/wps-prime-theme-post-meta.js',
			array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-data', 'wp-core-data' ),
			WPS_PRIME_THEME_VERSION
		);

		wp_register_style(
			'wps-prime-editor-style',
			get_template_directory_uri() . '/assets/gutenberg/wps-prime-theme-editor-style.css',
			array(),
			WPS_PRIME_THEME_VERSION
		);

		wp_enqueue_style( 'wps-prime-editor-style' );
	}


	/**
	 * Enqueue scripts and styles.
	 */
	public function theme_js() {
		/*
		 * SWIPER Slider Core
		 */
		wp_register_script( 'wps-slider-core', 'https://unpkg.com/swiper/swiper-bundle.min.js', array( 'jquery' ), WPS_PRIME_THEME_VERSION, true );

		/* Fancybox pack */
		wp_register_script( 'wps-fancybox-pack-js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array( 'jquery' ), WPS_PRIME_THEME_VERSION, true ); // Fancybox enable

		/* Slide menu core */
		wp_register_script( 'wps-slide-menu-core', THEME_URI . '/assets/dist/js/lib/side-slide-menu-core.js', array( 'jquery' ), WPS_PRIME_THEME_VERSION, true );

		/* Site JS */
		wp_register_script( 'wps-prime-site-js', THEME_URI . '/assets/dist/js/min/wps-prime.min.js', array( 'jquery', 'wps-slide-menu-core' ), WPS_PRIME_THEME_VERSION, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		/* Get theme settings */
		$use_sticky     = get_theme_mod( 'header_use_sticky', false );
		$main_menu_type = get_theme_mod( 'main_menu_type', 'menu_type_1' );

		// If set to false mega menu will be disabled
		$mega_menu = true;

		// If menu is under header switch sticky target
		$sticky_target = 'menu_type_2' === $main_menu_type ? '.site-nav-mega-menu' : '.site-header';

		// Conditionally load js
		if ( $use_sticky ) {
			wp_enqueue_script( 'sticky-nav', THEME_URI . '/assets/dist/js/lib/jquery.sticky.min.js', array( 'jquery' ), WPS_PRIME_THEME_VERSION, true );
		}

		wp_localize_script(
			'wps-prime-site-js',
			'themeSettings',
			array(
				'useSticky'    => $use_sticky,
				'stickyTarget' => $sticky_target,
				'megaMenu'     => $mega_menu,
			)
		);
		wp_enqueue_script( 'wps-prime-site-js' );
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function theme_css() {
		/** Fancybox style */
		wp_register_style( 'wps-fancybox-style', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.css' );
		wp_enqueue_style( 'wps-fancybox-style' );

		/* Enque main style */
		wp_register_style( 'wps-prime-style', THEME_URI . '/style.css', array(), WPS_PRIME_THEME_VERSION );
		wp_enqueue_style( 'wps-prime-style' );
	}

	/**
	 * Register theme sidebars.
	 */
	public function theme_sidebars() {

		/*
		* Register widget area.
		*
		* @link http://codex.wordpress.org/Function_Reference/register_sidebar
		*/

		register_sidebar(
			array(
				'name'          => __( 'Sidebar', 'wps-prime' ),
				'id'            => 'sidebar-1',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer widget area one', 'wps-prime' ),
				'id'            => 'sidebar-footer-1',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer widget area two', 'wps-prime' ),
				'id'            => 'sidebar-footer-2',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer widget area three', 'wps-prime' ),
				'id'            => 'sidebar-footer-3',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer widget area four', 'wps-prime' ),
				'id'            => 'sidebar-footer-4',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

	}

	/**
	 * Content meta boxes.
	 *
	 * @since 1.0.0
	 */

	public function theme_meta_boxes() {
		 /* Content Page Options */
		 include_once THEME_DIR . '/inc/meta-fields/pre-content-area.php';
	}

	/**
	 * Theme Typography
	 *
	 * @since 1.3.0
	 */
	public function theme_typography() {

		/* Theme font options generation class */
		include_once THEME_DIR . '/inc/typography/theme-typography-generator.php';

	}

	/**
	 * Setup theme options.
	 *
	 * @since 1.3.0
	 */
	public function theme_customizer() {
		include THEME_DIR . '/inc/customizer/customizer.php';
	}

	/**
	 * Theme base.
	 *
	 * Theme hooks / filters / walkers / shortcodes
	 * Functions used to build theme front end
	 *
	 * @since 1.0.0
	 */
	public function theme_base() {

		/* Theme hooks & hook display debug */
		include THEME_DIR . '/inc/hooks/theme-hooks.php';
		include THEME_DIR . '/inc/hooks/theme-debug-hooks.php';

		/* Theme filters */
		include THEME_DIR . '/inc/filters/css-class-filters.php';

		/* Run/Load theme fonts on front end */
		include THEME_DIR . '/inc/typography/theme-run-fonts.php';

		/* Custom widget options */
		include THEME_DIR . '/inc/theme-functions/theme-widget-options.php';

		/* Shortcodes */
		include THEME_DIR . '/inc/shortcodes/shortcodes.php';

		include THEME_DIR . '/inc/menus/menus.php';
		include THEME_DIR . '/inc/sidebars/sidebars.php';
	}

	public function theme_front_end_layout_setup() {
		include THEME_DIR . '/template-components/front-end-setup/theme-front-layout-setup.class.php';
	}

	/**
	 * Theme components
	 * Customized template components
	 * Always load theme objects first and then theme parts.
	 */
	public function theme_components() {

		include_once THEME_DIR . '/template-components/hook-components.php';

		/* Custom Comment list markup */
		include_once THEME_DIR . '/template-components/theme-front-comment-list.php';

		/* Custom template tags. */
		include_once THEME_DIR . '/template-components/class-theme-front-template-tags.php';

		 /* Header Layout */
		 include_once THEME_DIR . '/template-components/components/theme-header-layout.php';

		 /* render the main logo */
		 include_once THEME_DIR . '/template-components/components/theme-site-logo.php';

		require_once THEME_DIR . '/inc/meta-fields/menu-item-custom-fields.php';
		require_once THEME_DIR . '/inc/menu-walkers/main-nav-walker.php';
		require_once THEME_DIR . '/inc/menu-walkers/portable-nav-walker.php';
		require_once THEME_DIR . '/inc/menu-walkers/mega-menu-walker.php';
		require_once THEME_DIR . '/template-components/components/theme-menu.php';
		require_once THEME_DIR . '/template-components/components/theme-header-contact.php';
		require_once THEME_DIR . '/template-components/components/theme-header-content.php';
		require_once THEME_DIR . '/template-components/components/theme-translator-switcher.php'; // wpml

		 /* Before the main site content area component */
		 include_once THEME_DIR . '/template-components/components/theme-page-pre-content.php';

		 /* Global content component */
		 include_once THEME_DIR . '/template-components/components/theme-global-content.php';

		 /* Footer */
		 include_once THEME_DIR . '/template-components/components/theme-footer.php';

		 /* Site info component for footer */
		 include_once THEME_DIR . '/template-components/components/theme-footer-site-microcopy.php';
	}

	/**
	 * Image sizes
	 * Admin Columns
	 * Fine tune
	 */
	public function theme_settings() {
		/**
		 * WP Fine Tune
		 *
		 * - Remove all the version numers from the end of css/js enqueued files added to <head> (suggested by pingdom.com)
		 * - Remove Comment Form Allowed Tags
		 * - Customize Comment Form Place Holder Input Text Fields & Infotexts http://wpsites.net/web-design/customize-comment-form-place-holder-input-text-fields-labels/
		 * - Customize Comment Form Text Area & Infotext http://wpsites.net/web-design/customize-comment-field-text-area-label/
		 * - Custom functions that act independently of the theme templates.
		 */
		include THEME_DIR . '/inc/settings/wps-admin-theme-fine-tune.php';

		/**
		 *    Add media id to media library admin column
		 */
		include THEME_DIR . '/inc/admin/wps-admin-column-show-media-id.php';

		/**
		 *    Add post id to post list admin column
		 */
		include THEME_DIR . '/inc/admin/wps-admin-column-show-post-id.php';

		/**
		 *    Add page id to page list admin column
		 */
		include THEME_DIR . '/inc/admin/wps-admin-column-show-page-id.php';

		/**
		 *    Theme configurations
		 */

		/* Custom image sizes.  */
		include THEME_DIR . '/inc/settings/wps-admin-image-sizes.php';

		/* Typography Settings */
		include THEME_DIR . '/inc/settings/wps-admin-typography.php';
	}

	public function theme_woocommerce() {
		// Woocommerce
		require_once THEME_DIR . '/woo/woo-setup.php';
	}



}
new WPS_Prime_Init();
