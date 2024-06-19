<?php

/**
 * @link       https://dezhimself.com
 * @since      1.0.0
 * @package    Wp_Custom_Shaders
 * @author     Delano Walker <dez@dezhimself.com>
 */

 // If this file is called directly, abort.
 if ( ! defined( 'ABSPATH' ) ) { die; }

if ( ! class_exists( 'Wp_Custom_Shaders_App' ) ) :
class Wp_Custom_Shaders_App {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = PLUGIN_SLUG_NAME;
		$this->version = PLUGIN_VERSION;
		$this->formatted_name = ucwords( str_replace( '-', ' ', $this->plugin_name ) );

		add_filter( 'script_loader_tag', array( $this, 'shaders_load_as_ES6' ), 10, 3 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles'  ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_head', array( $this, 'shaders_add_js_vars' ) );
		add_action( 'wp_head', array( $this, 'wp_custom_shaders_custom_css' ) );	
		add_shortcode( 'wp_custom_shaders', array( $this, 'wp_custom_shaders_shortcode' ) );	
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-custom-shaders-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name . '-glslcanvas', plugin_dir_url( __FILE__ ) . 'js/GlslCanvas.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . '-fragment', plugin_dir_url( __FILE__ ) . 'js/fragment.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name. '-script', plugin_dir_url( __FILE__ ) . 'js/wp-custom-shaders-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Enable module mode on JS scripts
	 */
	public function shaders_load_as_ES6( $tag, $handle, $source ) {
        if( 'wp-custom-shaders-public' === $handle ||
			'GlslCanvas' == $handle ) {
            $tag ='<script src="' . $source . '" type="module" ></script>';
        }
        return $tag;
    }

	/**
	 * Add folder PHP variables for JS use
	 */
	public function shaders_add_js_vars() {
		?>
		<script type="text/javascript">
			var plugin_directory_uri = "<?php echo WP_CUSTOM_SHADERS_URL; ?>"
			var custom_hex_tl = '<?php if ( ! empty( get_option( PLUGIN_ID_NAME . '_color_2_option' ) ) )
									echo esc_html( get_option( PLUGIN_ID_NAME . '_color_2_option') ); else 
								echo ""?>';
			var custom_hex_tr = '<?php if ( ! empty( get_option( PLUGIN_ID_NAME . '_color_2_option' ) ) )
									echo esc_html( get_option( PLUGIN_ID_NAME . '_color_2_option') ); else 
								echo ""?>';
			var custom_hex_bl = '<?php if ( ! empty( get_option( PLUGIN_ID_NAME . '_color_3_option' ) ) )
									echo esc_html( get_option( PLUGIN_ID_NAME . '_color_3_option') ); else 
								echo ""?>';
			var custom_hex_br = '<?php if ( ! empty( get_option( PLUGIN_ID_NAME . '_color_4_option' ) ) )
									echo esc_html( get_option( PLUGIN_ID_NAME . '_color_4_option') ); else 
								echo ""?>';
			var custom_speed = '<?php echo esc_html( get_option( PLUGIN_ID_NAME . '_speed_option') ); ?>';
		</script>
		<?php
	}

	/**
	 * Shortcode for Application HTML
	 */
	public function wp_custom_shaders_shortcode( $atts ) {
		ob_start();
		require_once WP_CUSTOM_SHADERS_DIR . '/app/html/wp_custom_shaders_html.php';
		return ob_get_clean();
	}

	public function wp_custom_shaders_custom_css() {
		global $post;
		if ( has_shortcode( $post->post_content, 'wp_custom_shaders' ) ) {
			$css = ! empty( esc_html( get_option( PLUGIN_ID_NAME.'_custom_css_option' ) ) ) ? esc_html( get_option( PLUGIN_ID_NAME.'_custom_css_option' ) ) : '';
			if ( $css ) echo "<style type='text/css'>$css</style>";
		}
	}

}
endif;