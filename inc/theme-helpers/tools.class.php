<?php

class WPS_Prime_Tools {

	/**
	 Helper function to check if we are in the child theme
	 */
	private static function is_child() {

		// Gets a WP_Theme object for the current theme.
		$current_theme = wp_get_theme();

		// For limitation of empty() write in var.
		$parent = $current_theme->parent();
		if ( ! empty( $parent ) ) {
			return true;
		}
		return false;
	}

	// retrieves the attachment ID from the file URL
	public static function wps_get_image_id( $image_url ) {
		global $wpdb;
		$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );
		return $attachment[0];
	}

	/**
	 * Get size information for all currently-registered image sizes.
	 *
	 * @global $_wp_additional_image_sizes
	 * @uses   get_intermediate_image_sizes()
	 * @return array $sizes Data for all currently-registered image sizes.
	 */
	public static function get_image_sizes() {
		global $_wp_additional_image_sizes;

		$sizes  = array();
		$output = '';

		foreach ( get_intermediate_image_sizes() as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
				$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
				$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
				$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes[ $_size ] = array(
					'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
				);
			}
		}

		foreach ( $sizes as $image_size => $image_size_data ) {

			$crop = '';

			if ( is_array( $image_size_data['crop'] ) ) {
				$crop = 'true ' . $image_size_data['crop'][0] . '-' . $image_size_data['crop'][0];
			} else {
				$crop = $image_size_data['crop'] ? 'true auto' : 'false';
			}

			$output .= '<strong>' . $image_size . '</strong><br>' . $image_size_data['width'] . 'x' . $image_size_data['height'] . '<br>Croop: ' . $crop . '<hr/>';
		}

		return $output;
	}

	/**
	 * Create class array to be used as css classes for frontend components
	 *
	 * @param array  $class CSS Classes for element.
	 * @param string $filter_name Filter function name.
	 * @return array
	 */
	public static function generate_css_class( $class = '', $filter_name = '' ) {

		$classes = array();

		if ( ! empty( $class ) && ! empty( $filter_function ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class ); }
				$classes = array_merge( $classes, $class );
		} else {

			// Ensure that we always coerce class to being an array!
			$class = array();
		}

		 $classes = array_map( 'esc_attr', $classes );

		 /**
		  * Filter the list of CSS body classes for the current post or page.
		  *
		  * @since 2.8.0
		  *
		  * @param array  $classes An array of body classes.
		  * @param string $class   A comma-separated list of additional classes added to the body.
		  */
		 $classes = apply_filters( $filter_name, $classes, $class );

		 return array_unique( $classes );
	}

	/**
	 * @param $class
	 *
	 * @return string
	 */
	public static function generate_css_classes( $class, $flush = false ) {
		$output = '';
		$space  = $flush ? '' : ' ';

		// Check is we get an array
		if ( is_array( $class ) ) {
			$isFirst = 0;

			foreach ( $class as $css_class ) {
				++$isFirst;

				// if we have multiple values flush only the first space
				if ( 1 === $isFirst && $flush ) {
					$space = '';
				} else {
					$space = ' ';
				}

				// Check if we have a valid value and field is not empty
				if ( ! empty( $css_class ) ) {
					$output .= $space . $css_class;
				}
			}
		} else {
			// Check if we have a valid value and field is not empty
			if ( ! empty( $class ) ) {
				$output = $space . $class;
			}
		}

		return $output;
	}

	/**
	 *  Check if hex color is dark or light
	 */
	public static function contrast_color( $hexColor ) {
		   // hexColor RGB
		   $R1 = hexdec( substr( $hexColor, 1, 2 ) );
		   $G1 = hexdec( substr( $hexColor, 3, 2 ) );
		   $B1 = hexdec( substr( $hexColor, 5, 2 ) );

		   // Black RGB
		   $blackColor   = '#000000';
		   $R2BlackColor = hexdec( substr( $blackColor, 1, 2 ) );
		   $G2BlackColor = hexdec( substr( $blackColor, 3, 2 ) );
		   $B2BlackColor = hexdec( substr( $blackColor, 5, 2 ) );

			// Calc contrast ratio
			$L1 = 0.2126 * pow( $R1 / 255, 2.2 ) +
				  0.7152 * pow( $G1 / 255, 2.2 ) +
				  0.0722 * pow( $B1 / 255, 2.2 );

		   $L2 = 0.2126 * pow( $R2BlackColor / 255, 2.2 ) +
				 0.7152 * pow( $G2BlackColor / 255, 2.2 ) +
				 0.0722 * pow( $B2BlackColor / 255, 2.2 );

		   $contrastRatio = 0;
		if ( $L1 > $L2 ) {
			$contrastRatio = (int) ( ( $L1 + 0.05 ) / ( $L2 + 0.05 ) );
		} else {
			$contrastRatio = (int) ( ( $L2 + 0.05 ) / ( $L1 + 0.05 ) );
		}

		   // If contrast is more than 5, return black color
		if ( $contrastRatio > 5 ) {
			return 'light';
		} else {
			// if not, return white color.
			return 'dark';
		}
	}

	/**
	 * Get site info
	 */
	public static function get_development_data() {

		$current_theme   = '';
		$parent_theme    = '';
		$wp_data         = '';
		$plugin_location = WP_PLUGIN_DIR . '/converter-modules/modules-init.php';  // Get Plugin Directory
		$theme           = wp_get_theme();
		$is_child        = self::is_child( $theme );

		$short_data = '<span style="font-size:22px;font-weight:300;">Overview</span><br><br>';

		// Site Data.
		$short_data .= '<strong>Site Title</strong>: ' . get_bloginfo( 'name' ) . '<br>';
		$short_data .= '<strong>Tagline</strong>: ' . get_bloginfo( 'description' ) . '<br>';
		$short_data .= '<strong>SiteUrl</strong>: ' . site_url() . '<br>';
		$short_data .= '<strong>Stylesheet Directory</strong>: ' . get_template_directory_uri() . '<br>';
		$short_data .= '<strong>Template directory</strong>: ' . get_template_directory_uri() . '<br>';
		$short_data .= '<hr/>';
		$short_data .= '<strong>WordPress</strong>: ' . get_bloginfo( 'version' ) . '<br>';
		$short_data .= '<strong>Active theme</strong>: ' . $theme->get( 'Name' ) . ' v.<strong>' . $theme->get( 'Version' ) . '</strong><br><br>';

		// Current theme data.
		// Overview Part.
		$current_theme .= '<span style="font-size:22px;font-weight:300;">Current Theme Data</span><br><br>';
		$current_theme .= '<strong>Theme name:</strong> ' . $theme->get( 'Name' ) . '<br>';
		$current_theme .= '<strong>Theme URI:</strong> ' . $theme->get( 'ThemeURI' ) . '<br>';
		$current_theme .= '<strong>Text Domain:</strong> ' . $theme->get( 'TextDomain' ) . '<br>';
		$current_theme .= '<strong>Description:</strong> ' . $theme->get( 'Description' ) . '<br>';
		$current_theme .= '<strong>Author:</strong> ' . $theme->get( 'Author' ) . '<br>';
		$current_theme .= '<strong>AuthorURI:</strong> ' . $theme->get( 'AuthorURI' ) . '<br>';
		$current_theme .= '<strong>Theme Version:</strong> ' . $theme->get( 'Version' ) . '<br><br>';

		// Parent theme Data.
		if ( $is_child ) {

			$parent_t = $theme->parent();

			// Overview Part.
			$short_data .= '<strong>Parent Theme</strong>: ' . $parent_t->get( 'Name' ) . ' v.<strong>' . $parent_t->get( 'Version' ) . '</strong><br>';

			$parent_theme .= '<span style="font-size:22px;font-weight:300;">Parent Theme Data</span><br><br>';

			$parent_theme .= '<strong>Theme name:</strong> ' . $parent_t->get( 'Name' ) . '<br>';
			$parent_theme .= '<strong>Theme URI:</strong> ' . $parent_t->get( 'ThemeURI' ) . '<br>';
			$parent_theme .= '<strong>Text Domain:</strong> ' . $parent_t->get( 'TextDomain' ) . '<br>';
			$parent_theme .= '<strong>Description:</strong> ' . $parent_t->get( 'Description' ) . '<br>';
			$parent_theme .= '<strong>Author:</strong> ' . $parent_t->get( 'Author' ) . '<br>';
			$parent_theme .= '<strong>AuthorURI:</strong> ' . $parent_t->get( 'AuthorURI' ) . '<br>';
			$parent_theme .= '<strong>Theme Version:</strong> ' . $parent_t->get( 'Version' ) . '<br><br>';

		}

		// Get WordPress data.
		$wp_data .= '<span style="font-size:22px;font-weight:300;">WordPress Data</span><br>';

		$wp_data .= '<strong>Site Title</strong>' . get_bloginfo( 'name' ) . '<br>';

		return $short_data . '<br/><hr/>' . $current_theme . $parent_theme;
	}

	/**
	 *  Set how many words to show by character count
	 *  Set how many characters you desire and the function will trim text to WORDS
	 *  avoiding cutting words in the middle.
	 */
	public function excerpt( $charlength ) {
		$excerpt = get_the_excerpt();
		++$charlength;
		$output = '';

		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex   = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut   = -( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				 $output .= mb_substr( $subex, 0, $excut );
			} else {
				 $output .= $subex;
			}
			$output .= '...';
		} else {
			$output .= $excerpt;
		}

		return $output;
	}
}
