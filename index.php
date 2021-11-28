<?php
/*
 * Plugin Name: Upload Images Plugin
 * Plugin URI: https://github.com/rhildred/wordpress-export-import-tools
 * Description: Upload a zip, and unpack the images from it.
 * Author: Rich Hildred
 * Version: 1.0
 * Author URI: https://rhildred.github.io/
 * */

/** Step 2 (from text above). */
add_action( 'admin_menu', 'upload_images_form' );

/** Step 1. */
function upload_images_form() {
		add_management_page( 'Upload Image .zip', 'Upload Images', 'manage_options', 'upload-images-form', 'upload_images' );
}

/** Step 3. */
function upload_images() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	$sUrl = plugins_url("upload.php", __FILE__);
	echo <<< ENDFORM
	<h1>Zip Upload Form</h1>
	<p>Choose a zip file to upload and unzip to the images folder.</p>
	<form id="upload_form" action="$sUrl" enctype="multipart/form-data" method="post" target="messages">
	  <p><input name="upload" id="upload" type="file" accept="application/zip" /></p>
	  <p><input id="btnSubmit" type="submit" value="Upload Selected Zip" /></p>
	  <p><input id="reset_upload_form" type="reset" value="Reset form" /></p>
	</form>	
ENDFORM;	
}
