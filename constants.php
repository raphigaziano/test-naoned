<?php

// Debug settings
// --------------
// error_reporting(E_ALL | E_STRICT);

// Constants Definitions
// ---------------------

// Site pathes
define('SITE_ROOT', realpath(dirname(__FILE__)));
define('STATIC_ROOT', SITE_ROOT . '/static');

// Db settings
define('DB_CONNECTION_STRING', 'mysql:dbname=naoned_test;host=127.0.0.1');
define('DB_USER', 'naoned_test');
define('DB_PSWD', NULL);

?>

