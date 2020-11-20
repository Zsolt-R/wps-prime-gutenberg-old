<?php
/**
 * Custom Menu Walker
 * with BEM markup.
 */

/**
 * Custom theme navigation Walker.
 */
class Child_Main_Nav_Mega_Walker extends Walker_Nav_Menu {

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu().
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		if ( $depth === 0 ) {
			$output .= "\n$indent<div class=\"site-nav__list site-nav__container sub-menu level-" . $depth . "\"><div class=\"site-nav__column\">\n";
		} else {
			$output .= "\n$indent<ul class=\"site-nav__list sub-menu level-" . $depth . "\">\n";
		}
	}

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   menu item data object
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu().
	 * @param int    $id     current item ID
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		 global $wp_query;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $icon_start = $icon_end = '';

		$item_tag = 'a';

		$icon_position_start = false;

		if ( get_post_meta( $item->ID, 'menu-item-wps-position-start', true ) ) {
			$icon_position_start = true;
		}

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$classes[] = 'site-nav__item';

		$icon_class = get_post_meta( $item->ID, 'menu-item-wps-icon-class', true );

		/**
		 * Call to action
		 */
		if ( get_post_meta( $item->ID, 'menu-item-wps-ca-style-one', true ) === 'true' ) {
			$classes[] = 'menu-item--ca';
			$classes[] = 'menu-item--ca-style-one';
		}
		if ( get_post_meta( $item->ID, 'menu-item-wps-ca-style-two', true ) === 'true' ) {
			$classes[] = 'menu-item--ca';
			$classes[] = 'menu-item--ca-style-two';
		}

		// Align
		if ( get_post_meta( $item->ID, 'menu-item-wps-align-right', true ) === 'true' ) {
			$classes[] = 'menu-item--align-right';
		}

		/**
		 * Menu item icon
		 */
		if ( $icon_class ) {
			$classes[] = 'menu-item--use-icon';

			$icon_type = get_post_meta( $item->ID, 'menu-item-wps-icon-type', true );
			$icon      = '[wps_icon icon_family="' . $icon_type . '" icon_class="' . $icon_class . '" html_tag="span"]';

			if ( $icon_position_start ) {
				$icon_start = $icon . ' ';
			} else {
				$icon_end = ' ' . $icon;
			}
		}

		// Check if the item is marked as call to action
		if ( $depth === 0 ) {
			if ( get_post_meta( $item->ID, 'menu-item-wps-enable-mega-menu', true ) === 'true' ) {
				$classes[] = 'mega-menu-enabled';
			}
		}

		// Check if menu is set to behave like a submenu open trigger
		if ( get_post_meta( $item->ID, 'menu-item-wps-submenu-opener', true ) === 'true' ) {
			$classes[] = 'menu-item--show-submenu';
		}

		if ( $depth === 1 ) {
			$classes[] = 'site-nav__column-item-list';
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );

		$css_class = ' class="' . esc_attr( $class_names ) . '"';

		if ( $depth === 1 ) {
			$output .= $indent . '<div id="main-menu-item-' . $item->ID . '"' . $css_class . '>';
		} else {
			$output .= $indent . '<li id="main-menu-item-' . $item->ID . '"' . $css_class . '>';
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

		$item_output  = ! empty( $args->before ) ? $args->before : '';
		$item_output .= '<' . $item_tag . ' class="site-nav__link" ' . $attributes . '>';
		$item_output .= ! empty( $args->link_before ) ? $args->link_before : '';
		$item_output .= $icon_start;
		$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= $icon_end;
		$item_output .= ! empty( $args->link_after ) ? $args->link_after : '';
		$item_output .= '</' . $item_tag . '>';
		$item_output .= ! empty( $args->after ) ? $args->after : '';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of arguments. @see wp_nav_menu().
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$layout_break = '';
		/*
		 TODO */
		// Continue HERE
		// var_dump( $args->walker->has_children && $depth === 0);
		if ( get_post_meta( $item->ID, 'menu-item-wps-mega-divider', true ) === 'true' && $depth === 1 ) {
			$layout_break = '</div><div class="site-nav__column">';
		}

		if ( $depth === 1 ) {
			$output .= '</div>' . $layout_break;
		} else {
			$output .= '</li>';
		}
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );

		if ( $depth === 0 ) {
			$output .= "$indent</div></div>\n";
		} else {
			$output .= "$indent</ul>\n";
		}
	}
}
