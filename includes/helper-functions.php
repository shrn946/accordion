<?php
/**
 * Menu helper functions.
 *
 * @package WPDNM
 */

namespace WPDNM;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return available WordPress menus for an Elementor select control.
 *
 * @return array<string,string>
 */
function get_menu_options() {
	$options = array(
		'' => esc_html__( 'Select a menu', 'wp-dropdown-new-menu' ),
	);
	$menus   = wp_get_nav_menus();

	if ( ! empty( $menus ) && ! is_wp_error( $menus ) ) {
		foreach ( $menus as $menu ) {
			$options[ (string) $menu->term_id ] = esc_html( $menu->name );
		}
	}

	return $options;
}

/**
 * Build a recursive menu tree while preserving WordPress menu order.
 *
 * @param int $menu_id Menu term ID.
 * @return array<int,array<string,mixed>>
 */
function get_menu_tree( $menu_id ) {
	$items = wp_get_nav_menu_items(
		$menu_id,
		array(
			'update_post_term_cache' => false,
		)
	);

	if ( empty( $items ) || is_wp_error( $items ) ) {
		return array();
	}

	$grouped = array();

	foreach ( $items as $item ) {
		$parent_id = (int) $item->menu_item_parent;

		if ( ! isset( $grouped[ $parent_id ] ) ) {
			$grouped[ $parent_id ] = array();
		}

		$grouped[ $parent_id ][] = $item;
	}

	return build_menu_branch( 0, $grouped, array() );
}

/**
 * Recursively build a branch of menu items.
 *
 * @param int                          $parent_id Parent menu item ID.
 * @param array<int,array<int,object>> $grouped   Items grouped by parent.
 * @param array<int,bool>              $visited   Item IDs already traversed.
 * @return array<int,array<string,mixed>>
 */
function build_menu_branch( $parent_id, $grouped, $visited ) {
	if ( empty( $grouped[ $parent_id ] ) ) {
		return array();
	}

	$branch = array();

	foreach ( $grouped[ $parent_id ] as $item ) {
		$item_id = (int) $item->ID;

		if ( isset( $visited[ $item_id ] ) ) {
			continue;
		}

		$next_visited             = $visited;
		$next_visited[ $item_id ] = true;

		$branch[] = array(
			'item'     => $item,
			'children' => build_menu_branch( $item_id, $grouped, $next_visited ),
		);
	}

	return $branch;
}

