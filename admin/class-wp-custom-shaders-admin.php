<?php

/**
 *
 * @link       https://dezhimself.com
 * @since      1.0.0
 * @package    Wp_Custom_Shaders
 * @subpackage Wp_Custom_Shaders/admin
 * @author     Delano Walker <dez@dezhimself.com>
 */

 // If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {	die; }

if ( ! class_exists( 'Wp_Custom_Shaders_Admin' ) ) :
class Wp_Custom_Shaders_Admin {

	private $plugin_name;
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = PLUGIN_SLUG_NAME;
		$this->version = PLUGIN_VERSION;
		$this->formatted_name = ucwords( str_replace( '-', ' ', $this->plugin_name ) );	

		add_action( 'admin_init', array( $this, 'shaders_admin_init' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );	
		add_action( 'admin_menu', array( $this, 'shaders_add_admin_menu' ) );
	}

	public function shaders_admin_init() {

		//HTML settings section
		add_settings_section(
			'shader_settings',
			'Shader Settings',
			null,
			PLUGIN_SLUG_NAME . '-settings-page'
		);
		add_settings_section(
			'css_settings',
			sprintf('<h3>%s</h3>', __( 'Custom Styles', 'wpo_wcpdf_templates' )),
			null,
			PLUGIN_SLUG_NAME . '-settings-page'
		);

		//Add settings fields

		//company name
		add_settings_field(
			'color_1',
			'Color 1',
			function() {
				echo '<p><span>Changes the 1st color in the top left of the shader.</span></p>';
				printf('<input id="admin-color-field-1" name="%s_color_1_option" data-default-color="#0035e5" maxlength="7 type="text" id="color_1" value="' . esc_html( get_option( PLUGIN_ID_NAME . '_color_1_option' ) ) . '">',
					PLUGIN_ID_NAME, esc_html( get_option( PLUGIN_ID_NAME . '_color_1_option' ) ) );
			},
			PLUGIN_SLUG_NAME . '-settings-page',
			'shader_settings'
		);
		add_settings_field(
			'color_2',
			'Color 2',
			function() {
				echo '<p><span>Changes the 2nd color in the top left of the shader.</span></p>';
				printf('<input id="admin-color-field-2" name="%s_color_2_option" data-default-color="#5726a0" maxlength="7 type="text" id="color_2" value="' . esc_html( get_option( PLUGIN_ID_NAME . '_color_2_option' ) ) . '">',
					PLUGIN_ID_NAME, esc_html( get_option( PLUGIN_ID_NAME . '_color_2_option' ) ) );
			},
			PLUGIN_SLUG_NAME . '-settings-page',
			'shader_settings'
		);
		add_settings_field(
			'color_3',
			'Color 3',
			function() {
				echo '<p><span>Changes the 3rd color in the top left of the shader.</span></p>';
				printf('<input id="admin-color-field-3" name="%s_color_3_option" data-default-color="#f9ebcc" maxlength="7 type="text" id="color_3" value="' . esc_html( get_option( PLUGIN_ID_NAME . '_color_3_option' ) ) . '">',
					PLUGIN_ID_NAME, esc_html( get_option( PLUGIN_ID_NAME . '_color_3_option' ) ) );
			},
			PLUGIN_SLUG_NAME . '-settings-page',
			'shader_settings'
		);
		add_settings_field(
			'color_4',
			'Color 4',
			function() {
				echo '<p><span>Changes the 4th color in the top left of the shader.</span></p>';
				printf('<input id="admin-color-field-4" name="%s_color_4_option" data-default-color="#4ae2e8" maxlength="7 type="text" id="color_4" value="' . esc_html( get_option( PLUGIN_ID_NAME . '_color_4_option' ) ) . '">',
					PLUGIN_ID_NAME, esc_html( get_option( PLUGIN_ID_NAME . '_color_4_option' ) ) );
				},
			PLUGIN_SLUG_NAME . '-settings-page',
			'shader_settings'
		);
		add_settings_field(
			'speed',
			'Speed',
			function() {
				echo '<p><span>Controls the speed of the shader motions.</span></p>';
				printf('<input name="%s_speed_option" type="number" step="0.01" id="speed" value="' . esc_html( get_option( PLUGIN_ID_NAME . '_speed_option' ) ) . '">',
				PLUGIN_ID_NAME, esc_html( get_option( PLUGIN_ID_NAME . '_speed_option' ) ) );
			},
			PLUGIN_SLUG_NAME . '-settings-page',
			'shader_settings',
			array(
				'type' => 'text',
			),
		);

		//Custom CSS
		add_settings_field(
			'custom_css',
			'Custom CSS',
			function() {
				echo '<p><span>Use CSS to customize the HTML elements of the shader.</span></p>';
				printf( '<textarea class="admin-custom-css" name="%s_custom_css_option" cols="72" rows="8">%s</textarea>',
				PLUGIN_ID_NAME, esc_html( get_option( PLUGIN_ID_NAME . '_custom_css_option' ) ) );

			},
			PLUGIN_SLUG_NAME . '-settings-page',
			'css_settings'
		);

		//Save settings
		register_setting(
			PLUGIN_SLUG_NAME . '-settings-page-options-group',
			PLUGIN_ID_NAME . '_color_1_option',
			array(
				'string' => 'string',
				'description'=> 'Adds the 1st color in the top left of the shader.',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		register_setting(
			PLUGIN_SLUG_NAME . '-settings-page-options-group',
			PLUGIN_ID_NAME . '_color_2_option',
			array(
				'string' => 'string',
				'description'=> 'Adds the 2nd color in the top right of the shader.',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		register_setting(
			PLUGIN_SLUG_NAME . '-settings-page-options-group',
			PLUGIN_ID_NAME . '_color_3_option',
			array(
				'string' => 'string',
				'description'=> 'Adds the 3rd color in the bottom left of the shader.',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		register_setting(
			PLUGIN_SLUG_NAME . '-settings-page-options-group',
			PLUGIN_ID_NAME . '_color_4_option',
			array(
				'string' => 'string',
				'description'=> 'Adds the 4th color in the bottom right of the shader.',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		register_setting(
			PLUGIN_SLUG_NAME . '-settings-page-options-group',
			PLUGIN_ID_NAME . '_speed_option',
			array(
				'type' => 'number',
				'description'=> 'Controls the speed of the shader motions.',
				'default' => 0.05
			)
		);
		register_setting(
			PLUGIN_SLUG_NAME . '-settings-page-options-group',
			PLUGIN_ID_NAME . '_custom_css_option',
			array(
				'type' => 'text',
			)
		);
	}

	/**
	 * Add admin menu
	 *
	 * @since    1.0.0
	 */
	public function shaders_add_admin_menu() {
		
		//Main menu
		add_menu_page(
			$this->formatted_name,
			$this->formatted_name,
			'manage_options',
			$this->plugin_name . '-settings',
			array( $this, 'add_admin_menu_page_view' ),
			'dashicons-visibility',
			'60'
		);
	}

	public function add_admin_menu_page_view() {
		include_once WP_CUSTOM_SHADERS_DIR . '/admin/partials/wp-custom-shaders-admin-settings-display.php';
	}

	public function enqueue_styles() {

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-custom-shaders-admin.css', array(), $this->version, 'all' );

	}
	
	public function enqueue_scripts() {

		wp_enqueue_script( 'wp-color-picker' , false, true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-custom-shaders-admin.js', array( 'jquery' ), $this->version, false );

	}

}
endif;