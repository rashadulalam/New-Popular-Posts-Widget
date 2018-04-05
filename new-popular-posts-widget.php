<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://about.me/rashadulalam
 * @since             1.0.0
 * @package           New_Popular_Posts_Widget
 *
 * @wordpress-plugin
 * Plugin Name:       New Popular Posts Widget
 * Plugin URI:        https://wordpress.org/plugins/new-popular-posts-widget/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Rashadul Alam
 * Author URI:        http://about.me/rashadulalam
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-new-popular-posts-widget-activator.php
 */
function activate_new_popular_posts_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-new-popular-posts-widget-activator.php';
	New_Popular_Posts_Widget_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-new-popular-posts-widget-deactivator.php
 */
function deactivate_new_popular_posts_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-new-popular-posts-widget-deactivator.php';
	New_Popular_Posts_Widget_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_new_popular_posts_widget' );
register_deactivation_hook( __FILE__, 'deactivate_new_popular_posts_widget' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
 require plugin_dir_path( __FILE__ ) . 'includes/class-new-popular-posts-widgets-functions.php';
 require plugin_dir_path( __FILE__ ) . 'includes/class-new-popular-posts-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_new_popular_posts_widget() {

	$plugin = new New_Popular_Posts_Widget();
	$plugin->run();

}
run_new_popular_posts_widget();