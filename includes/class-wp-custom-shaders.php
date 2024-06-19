<?php
/**
 * @link       https://dezhimself.com
 * @since      1.0.0
 * @package    Wp_Custom_Shaders
 * @author     Delano Walker <dez@dezhimself.com>
 */

 if ( ! class_exists( 'Wp_Custom_Shaders' ) ) :
class Wp_Custom_Shaders {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;
	protected static $_instance = null;

	/**
	 * Main Plugin Instance
	 *
	 * Ensures only one instance of plugin is loaded or can be loaded.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'WP_CUSTOM_SHADERS_VERSION' ) ) {
			$this->version = WP_CUSTOM_SHADERS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = PLUGIN_SLUG_NAME;
		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->instantiate_app();
	}

	/**
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-custom-shaders-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'app/class-wp-custom-shaders-app.php';
	}

	/**
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new Wp_Custom_Shaders_Admin( $this->get_plugin_name(), $this->get_version() );
	}

	/**
	 * @since    1.0.0
	 * @access   private
	 */
	private function instantiate_app() {
		$plugin_public = new Wp_Custom_Shaders_App( $this->get_plugin_name(), $this->get_version() );
	}

	/**
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
endif;

/**
 * Returns the main instance of the plugin
 *
 * @since  1.0.0
 * @return Wp_Custom_Shaders
 */
function Wp_Custom_Shaders() {
	return Wp_Custom_Shaders::instance();
}