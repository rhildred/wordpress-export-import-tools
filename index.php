<?php
/*
 * Plugin Name: Migrate Images Plugin
 * Plugin URI: http://github.com/rhildred/gitwordpress/
 * Description: Import images into git, and import them
 * Author: Rich Hildred
 * Version: 1.0
 * Author URI: https://rhildred.github.io/
 * */

/** Step 2 (from text above). */
add_action( 'admin_menu', 'my_plugin_menu' );

/** Step 1. */
function my_plugin_menu() {
		add_options_page( 'My Plugin Options', 'My Plugin', 'manage_options', 'my-unique-identifier', 'my_plugin_options' );
}

/** Step 3. */
function my_plugin_options() {
		if ( !current_user_can( 'manage_options' ) )  {
					wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
						}
			echo '<div class="wrap">';
			echo '<p>Here is where the form would go if I actually had options.</p>';
				echo '</div>';
}
