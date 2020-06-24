<?php /*
    Plugin Name: Netfortis - Safety first
    Plugin URI: https://netfortis.pl/
    Description: Safety first
    Version: 2.1
    Author: Netfortis
    Author URI: https://netfortis.pl/
*/

function htaccessRules() {

    $htaccess = ABSPATH.'.htaccess';

    $lines = array();
    $lines[] = '<files wp-config.php>';
    $lines[] = '  order allow,deny';
    $lines[] = '  deny from all';
    $lines[] = '</Files>';

    insert_with_markers($htaccess, 'Netfortis', $lines);

    $htaccessUploads = ABSPATH.'wp-content/uploads/.htaccess';

    if (!file_exists($htaccessUploads)) {
        file_put_contents($htaccessUploads, '# htaccess');
    }

    $uploadHta = array();
    $uploadHta[] = '<Files *.php>';
    $uploadHta[] = '  order allow,deny';
    $uploadHta[] = '</Files>';

    insert_with_markers($htaccessUploads, 'Netfortis', $uploadHta);

}

add_filter( 'xmlrpc_enabled', '__return_false' );

// CUSTOM FILTERS / ACTIONS
add_action( 'activated_plugin', 'htaccessRules' );

remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );

define( 'DISALLOW_FILE_EDIT', true );
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_DISPLAY', false );
