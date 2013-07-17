<?php

// Debug settings
// --------------
// error_reporting(E_ALL | E_STRICT);

// Constants Definitions
// ---------------------

// Db settings
define('DB_CONNECTION_STRING', 'mysql:dbname=naoned_test;host=127.0.0.1');
define('DB_USER', 'naoned_test');
define('DB_PSWD', NULL);

// Shortcut, functions...
/**
 * Echoes the url to the the specified ressource, by prefixing it with 
 * '/static/'.
 * 
 * @param $ressource: path to ressource, relative to site_root/static/
 * @return void
 */
function get_static_url($ressource) {
    echo "/static/$ressource";
}
?>

