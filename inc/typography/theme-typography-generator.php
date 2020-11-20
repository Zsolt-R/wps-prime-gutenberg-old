<?php
/**
 *  Class to generate typography options
 *
 * @package wps_prime_2
 */

/**
 *  Class to generate a list of fonts (add/remove)
 *  We need the list to be accessible globally (Singleton approach)
 *
 * @example $myfont = WpsGenerateThemeFonts::get_instance();
 * @example $myfont->register_fonts(array(array('family' => 'Open Sans','type'   => 'sans-serif','url'    => 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800',)));
 * @example $myfontChild = WpsGenerateThemeFonts::get_instance();
 * @example $myfontChild ->remove_font('Open Sans');
 */
class WpsGenerateThemeFonts {

	private $fontList = array();

	private static $instance;

	private function __construct(){ }

	/**
	 * Use a static method and a static property to mediate object instantiation
	 * The $instance property is private and static, so it cannot be accessed from outside the class. The
	 * get_instance() method has access though. Because get_instance() is public and static, it can be called via
	 * the class from anywhere in a script.
	 */
	public static function get_instance() {
		if ( empty( self::$instance ) ) {
			self::$instance = new WpsGenerateThemeFonts();
		}
		return self::$instance;
	}

	/**
	 * Create font definition array
	 *
	 * @param array $font family | type | url
	 */
	private function add_font( $font ) {

		$font_id = strtolower( preg_replace( '/\s*/', '', $font['family'] ) );

		$this->fontList[ $font_id ] = $font;

		return $this->fontList;
	}

	/**
	 * Process font definition list
	 *
	 * @param array $font_list
	 * */
	public function register_fonts( $fonts ) {

		foreach ( $fonts as $font ) {

			// make sure we have all values and defaults
			$item = array(
				'family'  => $font['family'] ? $font['family'] : false,
				'type'    => $font['type'] ? $font['type'] : 'sans-serif',
				'url'     => $font['url'] ? $font['url'] : false,
				'weights' => $font['weights'] ? $font['weights'] : false,
			);

			$this->add_font( $item );
		}
	}

	/**
	 * Funtion to remove a font from font definition array using font name
	 * Run a foreach to search for font familiy name in a multi-array
	 * If found unset the single font definition array from the multi-array
	 *
	 * @param string $fontName Font family name ex. 'Raleway'
	 * @example $myfont = WpsGenerateThemeFonts::get_instance(); $myfont->remove_font('Raleway');
	 */
	public function remove_font( $fontName ) {

		$fonts = $this->fontList;

		foreach ( $fonts as $key => $singlefont ) {
			if ( in_array( $fontName, $singlefont ) ) {
				unset( $fonts[ $key ] );
			}
		}

		$this->fontList = $fonts;
	}

	public function return_font_list() {
		return $this->fontList;
	}
}
/**
 * Call theme font list
 *
 * @example $theme_fonts = new WpsGetThemeFonts;
 * @example $list_fonts = $theme_fonts->get_fonts();
 * @example $list_fonts = $theme_fonts->get_fonts_name();
 */
class WpsGetThemeFonts {
	/**
	 * Need to implement the following check before this class executes
	 *
	 * @todo 'return !empty($this->fontList) ? $this->fontList : array('no fonts defined');'
	 */

	private $fontList;
	private $fontNameList;
	private $font_link;

	public function __construct() {
		$this->fontList = WpsGenerateThemeFonts::get_instance()->return_font_list();
	}

	/**
	 * Return a multidimensional array of fonts avaliable
	 */
	public function get_fonts() {
		// Add empty element
		return $this->fontList;
	}

	/**
	 * Return a simple array of fonts names avaliable
	 */
	public function get_fonts_name() {

		foreach ( $this->fontList as $key => $font ) {
			$this->fontNameList[ $key ] = $font['family'] . ' (' . $font['type'] . ' / ' . $font['weights'] . ')';
		}
		return $this->fontNameList;
	}

	public function get_theme_fonts_link() {

		$theme_fonts = $this->get_fonts(); // Get registered fonts.

		$font_main   = get_theme_mod( 'wps_main_font_family' );// Get selected font family option.
		$font_second = get_theme_mod( 'wps_secondary_font_family' ); // Get selected font family option.

		// Prepare font
		$font_main_prep   = false;
		$font_second_prep = false;
		$display          = esc_attr( '&display=swap' );

		$font_main_prep = $theme_fonts[ $font_main ]['url'];

		// if no second font bail out early
		if ( ! get_theme_mod( 'wps_second_font_family_status' ) ) {
			return array( $font_main_prep );
		}

		/**
		 * Setup second font
		 */
		$font_second_prep = str_replace( 'https://fonts.googleapis.com/css2?family=', esc_attr( '&family=' ), $theme_fonts[ $font_second ]['url'] );

		/**
		 * Prepare retun cases
		 */

		// If the same font is selected send it in one call
		if ( $font_main === $font_second ) {
			return array( $theme_fonts[ $font_main ]['url'] );
		}

		// Fonts are from the same api we can concatenate in one call
		// Fonts are NOT from the same api we send fonts url separately
		$output = array();

			$font_string = sprintf(
				'%s%s%s',
				$font_main_prep,
				$font_second_prep,
				$display
			);

			$output = array( $font_string );

		return $output;

	}

	public function get_theme_font_style() {

		$theme_fonts = $this->get_fonts(); // Get registered fonts.

		$font_main          = get_theme_mod( 'wps_main_font_family' );
		$font_second        = get_theme_mod( 'wps_secondary_font_family' );
		$font_second_status = get_theme_mod( 'wps_second_font_family_status', false );
		$font_main_weight   = get_theme_mod( 'wps_main_font_weight', 400 );
		$font_second_weight = get_theme_mod( 'wps_second_font_weight', 600 );

		$style = '';

		$fonts = array();

		// If font one is set
		if ( $font_main ) {

			if ( 'empty' !== $font_main ) {
				$fonts[] = array(
					'selector' => '--theme-font-one',
					'value'    => '\'' . $theme_fonts[ $font_main ]['family'] . '\',' . $theme_fonts[ $font_main ]['type'],
				);
				$fonts[] = array(
					'selector' => '--theme-font-one-weight',
					'value'    => $font_main_weight,
				);
			}
		}

		// If font secondary is set and activated and is not the same as font main
		if ( $font_second_status && $font_second !== $font_main ) {
			$fonts[] = array(
				'selector' => '--theme-font-two',
				'value'    => '\'' . $theme_fonts[ $font_second ]['family'] . '\',' . $theme_fonts[ $font_second ]['type'],
			);
			$fonts[] = array(
				'selector' => '--theme-font-two-weight',
				'value'    => $font_second_weight,
			);
		}

		foreach ( $fonts as $font ) {
				$style .= $font['selector'] . ':' . $font['value'] . ';';
		}

		if ( $style ) {
			return ':root{' . $style . '}';
		} else {
			return false;
		}
	}
}

// Wrapper function to init font administration
function wps_fonts_setup() {
	return WpsGenerateThemeFonts::get_instance();
}
