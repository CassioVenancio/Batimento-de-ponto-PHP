<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
//error_reporting(0);
require_once(dirname(__FILE__) . '/src/config/config.php');


$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);


if($uri === '/' || $uri === '' || $uri === '/index.php') {
    $uri = '/day_records.php';
}

require_once(CONTROLLER_PATCH . "/{$uri}");




