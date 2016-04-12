<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

ini_set("display_errors", 1);
error_reporting(E_ALL);
//error_reporting(E_ALL|E_STRICT);
//ini_set('display_errors', 'on');

/**
 * Display all errors when APPLICATION_ENV is development.
 */
//if ($_SERVER['APPLICATION_ENV'] == 'development') {
//    error_reporting(E_ALL);
//    ini_set("display_errors", 1);
//}
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

// Setup autoloading
require 'init_autoloader.php';

//// Run the application!
//Zend\Mvc\Application::init(require 'config/application.config.php')->run();

if (!defined('APPLICATION_PATH')) {
    define('APPLICATION_PATH', realpath(__DIR__ . '/../'));
}

$appConfig = include APPLICATION_PATH . '/config/application.config.php';

if (file_exists(APPLICATION_PATH . '/config/development.config.php')) {
    $appConfig = Zend\Stdlib\ArrayUtils::merge($appConfig, include APPLICATION_PATH . '/config/development.config.php');
}

// Run the application!
Zend\Mvc\Application::init($appConfig)->run();
