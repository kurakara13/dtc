<?php
/**
 * WP Bootstrap Navwalker
 *
 * @package WP-Bootstrap-Navwalker
 */

/*
 * Class Name: WP_Bootstrap_Navwalker
 * Plugin Name: WP Bootstrap Navwalker
 * Plugin URI:  https://github.com/wp-bootstrap/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 5 navigation style in a custom theme using the WordPress built in menu manager.
 * Author: Edward McIntyre - @twittem, WP Bootstrap, William Patton - @pattonwebz
 * Version: 5.0.0
 * Author URI: https://github.com/wp-bootstrap
 * GitHub Plugin URI: https://github.com/wp-bootstrap/wp-bootstrap-navwalker
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * A custom WordPress nav walker class to implement the Bootstrap 5 navigation style in a custom theme using the WordPress built in menu manager.
 *
 * @since 2.0.4
 */
class WP_Bootstrap_Navwalker extends Walker_Nav_Menu {
	/**
	 * Starts the list before the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::start_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\" >\n";
	}

	/**
	 * Starts the element output.
	 *
	 * @since 3.0.0
	 * @since 4.0.0 The `$atts` parameter was added.
	 *
	 * @see Walker::start_el()
	 *
	 * @param string   $output       Used to append additional content (passed by reference).
	 * @param WP_Post  $data_object  Menu item data object.
	 * @param int      $depth        Depth of menu item. Used for padding.
	 * @param stdClass $args         An object of wp_nav_menu() arguments.
	 * @param int      $id           Current item ID.
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes   = empty( $data_object->classes ) ? array() : (array) $data_object->classes;
		$classes[] = 'menu-item-' . $data_object->ID;

		/**
		 * Filters the arguments for a single nav menu item.
		 *
		 * @since 4.4.0
		 *
		 * @param stdClass $args      An object of wp_nav_menu() arguments.
		 * @param WP_Post  $data_object  Menu item data object.
		 * @param int      $depth     Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $data_object, $depth );

		// If item has_children add dropdown class.
		if ( isset( $args->has_children ) && $args->has_children ) {
			$classes[] = 'dropdown';
		}

		if ( in_array( 'current-menu-item', $classes, true ) || in_array( 'current-menu-parent', $classes, true ) ) {
			$classes[] = 'active';
		}

		$classes[] = 'nav-item';
		$classes[] = 'nav-item-' . $data_object->ID;

		// If we are on the first level, prevent the li classes from being added.
		if ( 0 === $depth ) {
			$classes = array_diff(
				$classes,
				array(
					'menu-item',
					'page_item',
				)
			);
		}

		/**
		 * Filters the CSS class(es) applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array    $classes   Array of CSS classes that are applied to the menu item's `<li>` element.
		 * @param WP_Post  $data_object  The current menu item.
		 * @param stdClass $args      An object of wp_nav_menu() arguments.
		 * @param int      $depth     Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $data_object, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filters the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string   $menu_id   The ID that is applied to the menu item's `<li>` element.
		 * @param WP_Post  $data_object  The current menu item.
		 * @param stdClass $args      An object of wp_nav_menu() arguments.
		 * @param int      $depth     Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $data_object->ID, $data_object, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names . '>';

		$atts           = array();
		$atts['title']  = ! empty( $data_object->attr_title ) ? $data_object->attr_title : '';
		$atts['target'] = ! empty( $data_object->target ) ? $data_object->target : '';
		if ( '_blank' === $data_object->target && empty( $data_object->xfn ) ) {
			$atts['rel'] = 'noopener noreferrer';
		} else {
			$atts['rel'] = $data_object->xfn;
		}
		$atts['href']         = ! empty( $data_object->url ) ? $data_object->url : '';
		$atts['aria-current'] = $data_object->current ? 'page' : '';

		// If item has_children add dropdown attributes.
		if ( isset( $args->has_children ) && $args->has_children && 0 === $depth && $args->depth > 1 ) {
			$atts['href']          = '#';
			$atts['data-bs-toggle'] = 'dropdown';
			$atts['aria-haspopup'] = 'true';
			$atts['aria-expanded'] = 'false';
			$atts['class']         = 'dropdown-toggle nav-link';
			$atts['id']            = 'menu-item-dropdown-' . $data_object->ID;
		} else {
			if ( $depth > 0 ) {
				$atts['class'] = 'dropdown-item';
			} else {
				$atts['class'] = 'nav-link';
			}
		}

		$atts['class'] .= ( in_array( 'current-menu-item', $classes, true ) ) ? ' active' : '';

		/**
		 * Filters the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title        Title attribute.
		 *     @type string $target       Target attribute.
		 *     @type string $rel          The rel attribute.
		 *     @type string $href         The href attribute.
		 *     @type string $aria-current The aria-current attribute.
		 * }
		 * @param WP_Post  $data_object  The current menu item.
		 * @param stdClass $args      An object of wp_nav_menu() arguments.
		 * @param int      $depth     Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $data_object, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $data_object->title, $data_object->ID );

		/**
		 * Filters a menu item's title.
		 *
		 * @since 4.4.0
		 *
		 * @param string   $title     The menu item's title.
		 * @param WP_Post  $data_object  The current menu item.
		 * @param stdClass $args      An object of wp_nav_menu() arguments.
		 * @param int      $depth     Depth of menu item. Used for padding.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $data_object, $args, $depth );

		$item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filters a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string   $item_output The menu item's starting HTML output.
		 * @param WP_Post  $data_object  Menu item data object.
		 * @param int      $depth       Depth of menu item. Used for padding.
		 * @param stdClass $args        An object of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $data_object, $depth, $args );
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::end_el()
	 *
	 * @param string   $output      Used to append additional content (passed by reference).
	 * @param WP_Post  $data_object Menu item data object. Not used.
	 * @param int      $depth       Depth of menu item. Not used.
	 * @param stdClass $args        An object of wp_nav_menu() arguments.
	 */
	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
		if ( isset( $args->has_children ) && $args->has_children && 0 === $depth ) {
			$output .= "</li>\n";
		} else {
			$output .= "</li>\n";
		}
	}

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the 'fallback_cb' parameter
	 * of wp_nav_menu(), it will display a menu of pages as a fallback
	 * when no menu defined in Appearance -> Menus is available.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'edit_theme_options' ) ) {

			/* Get Arguments. */
			$container       = $args['container'];
			$container_id    = $args['container_id'];
			$container_class = $args['container_class'];
			$menu_class      = $args['menu_class'];
			$menu_id         = $args['menu_id'];

			if ( $container ) {
				echo '<' . esc_attr( $container );
				if ( $container_id ) {
					echo ' id="' . esc_attr( $container_id ) . '"';
				}
				if ( $container_class ) {
					echo ' class="' . esc_attr( $container_class ) . '"';
				}
				echo '>';
			}
			echo '<ul';
			if ( $menu_id ) {
				echo ' id="' . esc_attr( $menu_id ) . '"';
			}
			if ( $menu_class ) {
				echo ' class="' . esc_attr( $menu_class ) . '"';
			}
			echo '>';
			echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" title="">' . esc_attr( 'Add a menu', 'dtc' ) . '</a></li>';
			echo '</ul>';
			if ( $container ) {
				echo '</' . esc_attr( $container ) . '>';
			}
		}
	}

	/**
	 * Find any custom linkmod or icon classes and store in their holder
	 * arrays then remove them from the main classes array.
	 *
	 * Supported linkmods: .disabled, .dropdown-header, .dropdown-divider, .sr-only
	 * Supported iconsets: Font Awesome 4/5, Glypicons
	 *
	 * @since 4.0.0
	 *
	 * @param array   $classes         an array of classes.
	 * @param array   $linkmod_classes an array of linkmod classes.
	 * @param array   $icon_classes    an array of icon classes.
	 * @param integer $depth           an integer holding current depth level.
	 *
	 * @return array  $classes         a maybe modified array of classes.
	 */
	private function separate_linkmods_and_icons_from_classes( $classes, &$linkmod_classes, &$icon_classes, $depth ) {
		// Loop through $classes array to find linkmod or icon classes.
		foreach ( $classes as $key => $class ) {
			/*
			 * If any special classes are found, store the class in it's
			 * holder array and and unset the item from $classes.
			 */
			if ( preg_match( '/^disabled|^sr-only/i', $class ) ) {
				// Test for .disabled, .sr-only classes.
				$linkmod_classes[] = $class;
				unset( $classes[ $key ] );
			} elseif ( preg_match( '/^dropdown-header|^dropdown-divider|^dropdown-item-text/i', $class ) && $depth > 0 ) {
				/*
				 * Test for .dropdown-header, .dropdown-divider & .dropdown-item-text
				 * classes, and store them in their holder array.
				 *
				 * This is only triggered if the item is a sub-menu item.
				 */
				$linkmod_classes[] = $class;
				unset( $classes[ $key ] );
			} elseif ( preg_match( '/^fa-(\S*)?|^fa(s|r|l|b)?(\s?)?$/i', $class ) ) {
				// Font Awesome.
				$icon_classes[] = $class;
				unset( $classes[ $key ] );
			} elseif ( preg_match( '/^glyphicon-(\S*)?|^glyphicon(\s?)$/i', $class ) ) {
				// Glypicons.
				$icon_classes[] = $class;
				unset( $classes[ $key ] );
			}
		}

		return $classes;
	}
}

?>
