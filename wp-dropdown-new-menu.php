<?php
/**
 * Plugin Name: Flex Accordion
 * Description: Adds a responsive, WordPress menu-powered accordion widget for Elementor.
 * Version: 1.0.0
 * Author: WP Design Lab
 * Text Domain: wp-dropdown-new-menu
 * Requires at least: 6.0
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WPDNM_VERSION', '1.0.0' );
define( 'WPDNM_FILE', __FILE__ );
define( 'WPDNM_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPDNM_URL', plugin_dir_url( __FILE__ ) );

/**
 * Register frontend assets.
 *
 * Elementor enqueues these registered handles only when the widget is present.
 */
function wpdnm_register_assets() {
	wp_register_style(
		'wp-dropdown-new-menu',
		WPDNM_URL . 'assets/css/dropdown-new.css',
		array(),
		WPDNM_VERSION
	);

	wp_register_script(
		'wp-dropdown-new-menu',
		WPDNM_URL . 'assets/js/dropdown-new.js',
		array(),
		WPDNM_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'wpdnm_register_assets' );
add_action( 'elementor/frontend/after_register_styles', 'wpdnm_register_assets' );
add_action( 'elementor/frontend/after_register_scripts', 'wpdnm_register_assets' );

/**
 * Register the Elementor widget.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 */
function wpdnm_register_widget( $widgets_manager ) {
	require_once WPDNM_PATH . 'includes/helper-functions.php';

	if ( ! class_exists( '\WPDNM\Dropdown_New_Widget' ) ) {
		require_once WPDNM_PATH . 'widgets/dropdown-new-widget.php';
	}

	$widgets_manager->register( new \WPDNM\Dropdown_New_Widget() );
}
add_action( 'elementor/widgets/register', 'wpdnm_register_widget' );

/**
 * Display a dependency notice when Elementor is unavailable.
 */
function wpdnm_elementor_dependency_notice() {
	if ( did_action( 'elementor/loaded' ) ) {
		return;
	}

	$message = sprintf(
		/* translators: %s: Elementor plugin name. */
		esc_html__( 'Flex Accordion requires %s to be installed and activated.', 'wp-dropdown-new-menu' ),
		'Elementor'
	);

	printf(
		'<div class="notice notice-warning"><p>%s</p></div>',
		esc_html( $message )
	);
}
add_action( 'admin_notices', 'wpdnm_elementor_dependency_notice' );

