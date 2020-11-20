<?php
/**
 * Menu Item Custom Fields
 *
 * @package Menu_Item_Custom_Fields
 *
 * Plugin name: Menu Item Custom Fields
 * Plugin URI: https://github.com/kucrut/wp-menu-item-custom-fields
 * Description: Easily add custom fields to nav menu items.
 */

/**
 * Menu item metadata.
 *
 * This class demonstrate the usage of Menu Item Custom Fields in plugins/themes.
 *
 * @since 0.1.0
 */
class Theme_Menu_Item_Custom_Fields {

	/**
	 * Holds our custom fields.
	 *
	 * @var array
	 *
	 * @since  Theme_Menu_Item_Custom_Fields 0.2.0
	 */
	protected static $fields = array();

	/**
	 * Initialize plugin.
	 */
	public static function init() {
		add_action( 'wp_nav_menu_item_custom_fields', array( __CLASS__, '_fields' ), 10, 4 );
		add_action( 'wp_update_nav_menu_item', array( __CLASS__, '_save' ), 10, 3 );
		add_filter( 'manage_nav-menus_columns', array( __CLASS__, '_columns' ), 99 );

		$settings = array();

		if ( defined( 'WPS_FONTAWESOME_SUPPORT' ) ) {
			$settings['wps-icon-class']     = array(
				'label' => __( 'Icon Class ex. alien | visit: https://fontawesome.com', 'wps-prime' ),
				'type'  => 'text',
			);
			$settings['wps-icon-type']      = array(
				'label' => __( 'Select fontawesome icon type', 'wps-prime' ),
				'type'  => 'ico-type-select',
			);
			$settings['wps-position-start'] = array(
				'label' => __( 'Icon show at start', 'wps-prime' ),
				'type'  => 'checkbox',
			);
		}

		$settings['wps-ca-style-one'] = array(
			'label' => __( 'Call to action style one', 'wps-prime' ),
			'type'  => 'checkbox',
		);

		$settings['wps-ca-style-two'] = array(
			'label' => __( 'Call to action style two', 'wps-prime' ),
			'type'  => 'checkbox',
		);

		$settings['wps-enable-mega-menu'] = array(
			'label' => __( 'Enable mega menu', 'wps-prime' ),
			'type'  => 'checkbox',
			'depth' => 0,
			'limit' => 0,
		);
		$settings['wps-mega-divider']     = array(
			'label' => __( 'Enable mega menu next column', 'wps-prime' ),
			'type'  => 'checkbox',
			'depth' => 1,
			'limit' => 1,
		);

		$settings['wps-submenu-opener'] = array(
			'label' => __( 'Disable link (use as sub-menu opener)', 'wps-prime' ),
			'type'  => 'checkbox',
		);
		$settings['wps-align-right']    = array(
			'label' => __( 'Align Right', 'wps-prime' ),
			'type'  => 'checkbox',
			'depth' => 0,
			'limit' => 0,
		);

		self::$fields = $settings;
	}

	/**
	 * Save custom field value.
	 *
	 * @wp_hook action wp_update_nav_menu_item
	 *
	 * @param int   $menu_id         Nav menu ID
	 * @param int   $menu_item_db_id Menu item ID
	 * @param array $menu_item_args  Menu item data
	 */
	public static function _save( $menu_id, $menu_item_db_id, $menu_item_args ) {
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

		foreach ( self::$fields as $_key => $label ) {
			$key = sprintf( 'menu-item-%s', $_key );

			// Sanitize
			if ( ! empty( $_POST[ $key ][ $menu_item_db_id ] ) ) {
				// Do some checks here...
				$value = $_POST[ $key ][ $menu_item_db_id ];
			} else {
				$value = null;
			}

			// Update
			if ( ! is_null( $value ) ) {
				update_post_meta( $menu_item_db_id, $key, $value );
			} else {
				delete_post_meta( $menu_item_db_id, $key );
			}
		}
	}

	/**
	 * Print field.
	 *
	 * @param object $item  menu item data object
	 * @param int    $depth Depth of menu item. Used for padding.
	 * @param array  $args  menu item args
	 * @param int    $id    nav menu ID
	 *
	 * @return string Form fields
	 */
	public static function _fields( $id, $item, $depth, $args ) {
		foreach ( self::$fields as $_key => $data ) :
			$key   = sprintf( 'menu-item-%s', $_key );
			$id    = sprintf( 'edit-%s-%s', $key, $item->ID );
			$name  = sprintf( '%s[%s]', $key, $item->ID );
			$value = get_post_meta( $item->ID, $key, true );
			$class = sprintf( 'field-%s', $_key );

			/**
			 * Check if field is limited to a certain depth
			 * Check if we set a depth show it only starting from that depth
			*/
			if ( isset( $data['limit'] ) ) {
				if ( $data['limit'] === $depth ) {
					self::_render_field( $id, $key, $name, $value, $class, $data );
				}
			} elseif ( isset( $data['depth'] ) ) {
				if ( $depth >= $data['depth'] ) {
					self::_render_field( $id, $key, $name, $value, $class, $data );
				}
			} else {
				self::_render_field( $id, $key, $name, $value, $class, $data );
			}

		endforeach;
	}

	public static function _render_field( $id, $key, $name, $value, $class, $data ) {

		$data_type = isset( $data['type'] ) ? $data['type'] : 'text';

		?>
		<p class="description description-wide <?php echo esc_attr( $class ); ?>">
		<?php
		if ( 'text' === $data_type ) {
			printf(
				'<label for="%1$s">%2$s<br /><input type="text" id="%1$s" class="widefat %1$s" name="%3$s" value="%4$s" /></label>',
				esc_attr( $id ),
				esc_html( $data['label'] ),
				esc_attr( $name ),
				esc_attr( $value )
			);
		} elseif ( 'checkbox' === $data_type ) {
			printf(
				'<label for="%1$s"><input type="checkbox" id="%1$s" class="widefat %1$s" name="%3$s" value="true" %4$s/> %2$s</label>',
				esc_attr( $id ),
				esc_html( $data['label'] ),
				esc_attr( $name ),
				( isset( $value ) ? checked( $value, 'true', false ) : '' )
			);
		} elseif ( 'ico-type-select' === $data_type ) {
			printf(
				'<label for="%1$s">%2$s
				   <select id="%1$s" name="%3$s" class="widefat">
				   <option value="">---</option>
				   <option value="regular" ' . ( isset( $value ) ? selected( $value, 'regular', false ) : '' ) . '>Regular</option>
				   <option value="solid" ' . ( isset( $value ) ? selected( $value, 'solid', false ) : '' ) . '>Solid</option>
				   <option value="light" ' . ( isset( $value ) ? selected( $value, 'light', false ) : '' ) . '>Light</option>
				   <option value="duotone" ' . ( isset( $value ) ? selected( $value, 'duotone', false ) : '' ) . '>Duotone</option>
				   <option value="brands" ' . ( isset( $value ) ? selected( $value, 'brands', false ) : '' ) . '>Brands</option>
				   </select></label>',
				esc_attr( $id ),
				esc_html( $data['label'] ),
				esc_attr( $name )
			);
		}
		?>
   </p>
		<?php
	}

	/**
	 * Add our fields to the screen options toggle.
	 *
	 * @param array $columns Menu item columns
	 *
	 * @return array
	 */
	public static function _columns( $columns ) {
		$columns = array_merge( $columns, self::$fields );

		return $columns;
	}
}
Theme_Menu_Item_Custom_Fields::init();
