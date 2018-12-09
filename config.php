<?php

// check for scheme and define paths for consts
if (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {

    $scheme = 'https://';
} else {

    $scheme = 'http://';
}

define('HTTP_HOST', $scheme . getenv('HTTP_HOST'));
define('ROOT_DIR', dirname(__FILE__));
define('ROOT_URL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(ROOT_DIR))));
define('SCRIPT_NAME', basename($_SERVER['PHP_SELF']));

// define projectname
define('PROJECT_NAME', '');

if (HTTP_HOST === "http://localhost") {

    // define error display stages (Development)
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // define debug console (Development)
    define('DEBUG_OUTPUT', 'true');

    // define db consts
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'advanced_coding_shop');
    define('DB_TABLE_NAME', '');
} elseif (HTTP_HOST === "https://acws191.erlenkaemper.eu") {

    // define error display stages (Production)
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ERROR);

    // define debug console (Production)
    define('DEBUG_OUTPUT', 'false');

    // define db consts
    define('DB_USER', 'acws191');
    define('DB_PASS', 'hoZwas-nudror-hipmi2');
    define('DB_HOST', 'localhost:3306');
    define('DB_NAME', 'acws191');
    define('DB_TABLE_NAME', '');
}

// start globally session handling
session_start();

// auto include classes
function __autoload($className) {

    $classFile = HTTP_HOST . ROOT_URL . PROJECT_NAME . '/class/' . $className . '.class.php';
    $fileHeaders = @get_headers($classFile);

    if ($fileHeaders[0] == 'HTTP/1.1 200 OK' || $fileHeaders[0] === 'HTTP/1.1 301 Moved Permanently') {
        require_once(trim(__DIR__ . '/class/' . $className . '.class.php'));
    } else {
        throw new Exception('Unable to load ' . $className);
    }
}
