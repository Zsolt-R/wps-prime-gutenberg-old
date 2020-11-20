<?php
/**
 * Contains methods for customizing the theme customization screen.
 * WPS Prime 2 Theme Customizer.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @package WPS_Prime_2
 */

class WPS_Customizer {

	private static $instance = null;

	public $config = array(
		'branding',
		'header-setup',
		'footer-setup',
		'typography',
		'site-content',
		'woo-category',
		'woo-colors-checkout',
		'woo-colors-header-utility',
		'woo-colors-messages',
		'woo-colors-shop',
		'woo-shop',
		'woo-single',
		'translator',
		'dev-tweaks',
		'style-runner',
	);

	public $path      = THEME_DIR . '/inc/customizer/classes/';
	public $extension = '.class.php';

	private function __construct() {
		$this->class_loader();
	}

	public static function getInstance() {
		if ( self::$instance == null ) {
			self::$instance = new WPS_Customizer();
		}
		return self::$instance;
	}

	private function class_loader() {
		foreach ( $this->config as $section ) {
			include_once $this->path . $section . $this->extension;
		}
	}

}
$customizer = WPS_Customizer::getInstance();

