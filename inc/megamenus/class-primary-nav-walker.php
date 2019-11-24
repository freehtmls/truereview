<?php
/**
 * Custom wp_nav_menu walker for primary menu.
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class TrueReview_Custom_Nav_Walker extends Walker_Nav_Menu {

	public $megamenu = false;
	public $columns  = 'two-columns';

	/**
	 * Starts the list before the elements are added.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);

		if ( $this->megamenu && $depth == 0 ) {
			$output .= "\n$indent<ul class=\"mega-links $this->columns\">\n";
		} elseif ( $this->megamenu && $depth == 1 ) {
			$output .= "\n$indent<ul class=\"sub-mega\">\n";
		} else {
			$output .= "\n$indent<ul class=\"sub-menu\">\n";
		}

	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);

		if ( $this->megamenu && $depth == 0 ) {
			$output .= "\n$indent</ul>\n";
		} elseif ( $this->megamenu && $depth == 1 ) {
			$output .= "\n$indent</ul>\n";
		} else {
			$output .= "\n$indent</ul>\n";
		}

	}

	/**
	 * Modified the menu output.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		// Set up empty variable.
		$class_names = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		if ( in_array( 'menu-item-home', $item->classes ) ) {
			$classes[] = 'home_item';
		}

		/**
		 * Filter the CSS class(es) applied to a menu item's <li>.
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's <li>.
		 *
		 * @param string $menu_id The ID that is applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		// <li> output.
		$output .= $indent . '<li ' . $id . $class_names .'>';

		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		if ( $this->megamenu && $depth == 1 ) {
			$item_output = sprintf( '%1$s<span class="column-heading">%2$s</span>%3$s',
				$args->before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->after
			);

		} else {
			// Menu output.
			$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
			);
		}

		// Build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		/**
		 * Initialize the mega menu.
		 */
		if ( $depth == 0 ) {
			$this->megamenu = false;
		}

		if ( $item->megamenu ) {
			$this->megamenu = true;
			$this->columns = $item->megamenu_columns;
		}

	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {

		if( $this->megamenu && $depth == 1 ) {
			$output .= "</li>\n";
		} else {
			$output .= "</li>\n";
		}

	}

}
