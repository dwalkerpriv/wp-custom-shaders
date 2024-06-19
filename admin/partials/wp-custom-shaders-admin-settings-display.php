<?php

/**
 *
 * @link       https://dezhimself.com
 * @since      1.0.0
 *
 * @package    Wp_Custom_Shaders
 * @subpackage Wp_Custom_Shaders/admin/partials
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
    <H1>Settings</H1>
    <p>Paste the shortcode <strong>[wp_custom_shaders]</strong> inside the page that you want the shaders to load on.</p>
    <hr>
    <?php settings_errors(); ?>
    <form action="options.php" method="post">
        <?php
            //Security
            settings_fields( PLUGIN_SLUG_NAME . '-settings-page-options-group' );

            //Display section
            do_settings_sections( PLUGIN_SLUG_NAME . '-settings-page' );
        ?>
        <?php submit_button(); ?>
    </form>
</div>