<?php
define( 'WP_DEBUG', true );

define( 'WP_DEBUG_DISPLAY', true );

define( 'WP_DEBUG_LOG', true );

//provides access to WP environment
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
$_FILES['upload']['target'] = wp_upload_dir()['basedir'];  
print_r($_FILES);
$zip = new ZipArchive;
if ($zip->open($_FILES['upload']['tmp_name']) === TRUE) {
    $zip->extractTo($_FILES['upload']['target']);
    $zip->close();
    echo 'ok';
} else {
    echo 'failed';
}
