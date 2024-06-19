<?php

/**
 *
 * @link              https://dezhimself.com
 * @since             1.0.0
 * @package           Wp_Custom_Shaders
 *
 * @wordpress-plugin
 * Plugin Name:       Wordpress Custom Shaders
 * Plugin URI:        https://dezhimself.com
 * Description:       Inserts a custom GLSL shader into the your web pages. Works well for hero sections.
 * Version:           1.0.0
 * Author:            Delano Walker
 * Author URI:        https://dezhimself.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-custom-shaders
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

if( ! defined("WP_CUSTOM_SHADERS_DIR" ) ) define( "WP_CUSTOM_SHADERS_DIR", plugin_dir_path(__FILE__) );
if( ! defined("WP_CUSTOM_SHADERS_URL" ) ) define( "WP_CUSTOM_SHADERS_URL", plugin_dir_url(__FILE__) );
if( ! defined("WP_CUSTOM_SHADERS" ) ) define( "WP_CUSTOM_SHADERS", plugin_basename(__FILE__) );

if( ! defined("PLUGIN_VERSION" ) ) define( 'PLUGIN_VERSION', '1.0.0' );
if( ! defined("PLUGIN_NAME" ) ) define( 'PLUGIN_NAME', 'WP Custom Shaders' );
if( ! defined("PLUGIN_SLUG_NAME" ) ) define( 'PLUGIN_SLUG_NAME', 'wp-custom-shaders' );
if( ! defined("PLUGIN_ID_NAME" ) ) define( 'PLUGIN_ID_NAME', 'wp_custom_shaders' );


function activate_wp_custom_shaders() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-custom-shaders-activator.php';
	Wp_Custom_Shaders_Activator::activate();
}

function deactivate_wp_custom_shaders() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-custom-shaders-deactivator.php';
	Wp_Custom_Shaders_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_custom_shaders' );
register_deactivation_hook( __FILE__, 'deactivate_wp_custom_shaders' );

require plugin_dir_path( __FILE__ ) . 'includes/class-wp-custom-shaders.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_custom_shaders() {
	Wp_Custom_Shaders::instance();
}
run_wp_custom_shaders();
