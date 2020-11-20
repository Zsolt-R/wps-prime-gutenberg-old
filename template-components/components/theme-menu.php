<?php

/**
 * Theme Site Nav.
 *
 * Contains the main site Nav
 */

/**
 * Main site navigation
 * mobile navigation toggle button.
 */
class WpsNavigation {

	// Hold the class instance.
	private static $instance = null;

	private $nav_main;
	private $nav_side;
	private $nav_mask;
	private $nav_mega_main;
	private $nav_display_status;

	// Private constructor.
	private function __construct() {
		$this->nav_display_status = $this->set_nav_display_status();
		$this->nav_main           = $this->create_nav_main();
		$this->nav_side           = $this->create_nav_side();
		$this->nav_mask           = $this->create_nav_mask();
		$this->nav_mega_main      = $this->create_nav_mega_main();
	}

	public static function getInstance() {
		if ( ! self::$instance ) {
			self::$instance = new WpsNavigation();
		}

		return self::$instance;
	}

	/**
	 * Toggle button to be used as component.
	 */
	private function render_toggler( $class = 'c-slide-nav-toggler', $label = 'MENU', $id = 'c-slide-nav-toggler--slide-right' ) {
		$label   = ''; // '<span class="c-slide-nav-toggler__label">'.$label.'</span>';
		$ico     = '<span class="c-slide-nav-toggler-icon"><span></span><span></span><span></span><span></span></span>';
		$main_id = $id ? 'id="' . $id . '"' : '';

		return '<button ' . $main_id . ' class="' . $class . '">' . $label . $ico . '</button>';
	}

	/**
	 * Build main navigation.
	 */
	private function create_nav_main() {
		$output = '';

		$menu_args = array(
			'theme_location'  => 'primary',
			'menu_class'      => 'site-nav__list',
			'container_class' => 'site-nav__menu-container',
			'walker'          => 'Child_Main_Nav_Walker',
			'echo'            => false,
		);

		$output .= '<nav id="site-nav"' . wps_prime_theme_nav_class() . ' data-ui-component="site-main-nav">';
		$output .= '<div class="site-nav-wrapper">';
		$output .= has_nav_menu( 'primary' ) && $this->nav_display_status ? wp_nav_menu( $menu_args ) : '';
		$output .= '</div>';
		$output .= '</nav><!-- #site-nav -->';
		$output .= '<div class="side-nav-menu-toggler">' . $this->render_toggler( 'c-slide-nav-toggler c-slide-nav-toggler--themed' ) . '</div>';

		return $output;
	}

	/**
	 * Build main navigation.
	 */
	private function create_nav_mega_main() {
		$output = '';

		$menu_type      = get_theme_mod( 'main_menu_type', 'menu_type_1' );
		$site_nav_class = '';

		if ( 'menu_type_2' === $menu_type ) {
			$site_nav_class = ' site-nav-has-background-color';
		}

		$menu_args = array(
			'theme_location'  => 'primary',
			'menu_class'      => 'site-nav__list',
			'container_class' => 'site-nav__menu-container',
			'walker'          => 'Child_Main_Nav_Mega_Walker',
			'echo'            => false,
		);

		$output .= '<div class="site-nav-mega-menu' . $site_nav_class . '">';
		$output .= '<nav id="site-nav"' . wps_prime_theme_nav_class() . ' data-ui-component="site-main-nav">';
		$output .= '<div class="site-nav-wrapper"><div class="o-wrapper">';
		$output .= has_nav_menu( 'primary' ) && $this->nav_display_status ? wp_nav_menu( $menu_args ) : '';
		$output .= '</div></div>';
		$output .= '</nav><!-- #site-nav -->';
		// $output .= 'menu_type1' === $menu_type ? '<div class="side-nav-menu-toggler">' . $this->render_toggler( 'c-slide-nav-toggler c-slide-nav-toggler--themed' ) . '</div>' : '';
		$output .= '</div>';

		return $output;
	}

	/**
	 * Build side Navigation.
	 */
	private function create_nav_side() {
		$output = '';

		$has_nav_mobile = has_nav_menu( 'primary_mobile' );

		$nav_id = $has_nav_mobile ? 'primary_mobile' : 'primary';

		$side_menu_args = array(
			'theme_location' => $nav_id,
			'menu_class'     => 'c-slide-nav__items',
			'walker'         => new Child_Theme_Mobile_Menu_Object(),
			'echo'           => false,
		);

		$side_menu_args_two = array(
			'theme_location' => 'primary_two',
			'menu_class'     => 'c-slide-nav__items',
			'walker'         => new Child_Theme_Mobile_Menu_Object(),
			'echo'           => false,
		);

		$output .= '<nav id="c-slide-nav--slide-right"' . wps_prime_theme_mobile_nav_class() . '>';
		$output .= '<div class="c-slide-nav__nav-wrapper">';
		$output .= '<div class="c-slide-nav__close">' . $this->render_toggler( 'c-slide-nav-close', 'CLOSE', false ) . '</div>';
		$output .= has_nav_menu( 'primary' ) && $this->nav_display_status ? wp_nav_menu( $side_menu_args ) : '';
		$output .= '<div class="c-slide-nav__social-list">' . do_shortcode( '[wps_social_links link_class="u-text-color-invert"]' ) . '</div>';
		$output .= $this->contact_data();
		$output .= $this->translator();
		$output .= '</div>'; // c-slide-nav__nav-wrapper
		$output .= '</nav>'; // c-slide-nav slide-right

		return $output;
	}

	/**
	 * Translator
	 */
	private function translator() {
		if ( ! function_exists( 'icl_object_id' ) ) {
			return;
		}
		if ( get_theme_mod( 'translation_switcher_display', false ) ) {
			return '<div class="c-slide-nav__translator">' . do_shortcode( '[wpml_language_selector_widget]' ) . '</div>';
		}

	}

	/**
	 * Build mask.
	 */
	private function create_nav_mask() {
		return '<div id="c-slide-nav-mask" class="c-slide-nav-mask"></div><!-- /c-mask -->';
	}

	private function contact_data() {

		$output    = '';
		$has_phone = get_theme_mod( 'header_show_phone', false );
		$has_email = get_theme_mod( 'header_show_email', false );

		if ( ! $has_phone && ! $has_email ) {
			return;
		}

		$phone_main = get_option( 'wps_phone_nr' );
		$email_main = get_option( 'wps_email_address' );
		$icons      = WPS_Prime_Theme_Icon::getInstance();

		if ( $phone_main && $has_phone ) {
			$output .= '<a class="contact-data__item wps-phone-link" href="tel:' . $phone_main . '">' . $icons::getIcon( 'phone' ) . ' ' . $phone_main . '</a>';
		}
		if ( $email_main && $has_email ) {
			$output .= '<a class="contact-data__item wps-email-link" href="mailto:' . $email_main . '">' . $icons::getIcon( 'envelope' ) . ' ' . $email_main . '</a>';
		}

		return '<div class="contact-data">' . $output . '</div>';
	}

	/**
	 * Export components.
	 */
	public function get_nav_main() {
		return $this->nav_main;
	}

	public function get_nav_mega_main() {
		return $this->nav_mega_main;
	}

	public function get_nav_side() {
		return $this->nav_side;
	}

	public function get_nav_mask() {
		return $this->nav_mask;
	}

	public function get_toggler() {
		return $this->render_toggler( 'c-slide-nav-toggler c-slide-nav-toggler--themed' );
	}

	private function set_nav_display_status() {
		if ( is_page() && 'true' === get_post_meta( get_the_id(), '_hide_main_menu', true ) ) {
			return false;
		}
		return true;
	}
}

function wps_theme_main_site_nav( $menu ) {
	$menu = WpsNavigation::getInstance();

	$menu_type = get_theme_mod( 'main_menu_type', 'menu_type1' );

	// Allow mega menu all the time
	echo $menu->get_nav_mega_main();

	/*
	if ( 'menu_type1' === $menu_type ) {
		echo $menu->get_nav_main();
	} elseif ( 'menu_type2' === $menu_type ) {
		echo $menu->get_nav_mega_main();
	}
	*/
}

function wps_theme_slide_push_menu() {
	$menu = WpsNavigation::getInstance();
	echo $menu->get_nav_side();
}

function wps_theme_slide_push_menu_mask() {
	$menu = WpsNavigation::getInstance();
	echo $menu->get_nav_mask();
}

function wps_theme_main_site_mobile_nav_toggler() {
	$menu = WpsNavigation::getInstance();
	echo $menu->get_toggler();
}
