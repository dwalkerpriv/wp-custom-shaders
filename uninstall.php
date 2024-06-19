<?php

/**
 *
 * @link       https://dezhimself.com
 * @since      1.0.0
 * @package    Wp_Custom_Shaders
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {	exit; }

if ( current_user_can( 'manage_options' ) ) {
	delete_option( 'wp_custom_shaders_color_1_option' );
	delete_option( 'wp_custom_shaders_color_2_option' );
	delete_option( 'wp_custom_shaders_color_3_option' );
	delete_option( 'wp_custom_shaders_color_4_option' );
	delete_option( 'wp_custom_shaders_speed_option' );
	delete_option( 'wp_custom_shaders_custom_css_option' );
}