<?php

/**
 * -----------------------------------------------------------------------------
 * By default, the API application environment will be considered `development`,
 * this can be changed manually here, although it is recommended that your
 * environment is set via a server defined environment variable
 * -----------------------------------------------------------------------------
 */
define('API_ENV', 'development');

/**
 * -----------------------------------------------------------------------------
 * Handle autoloading of packages
 * -----------------------------------------------------------------------------
 */
include __DIR__ . '/../vendor/autoload.php';

/**
 * -----------------------------------------------------------------------------
 * Application level autoloading
 * -----------------------------------------------------------------------------
 */
$autoloader = (new Orno\Loader\Psr4Autoloader)->import(
    include __DIR__ . '/../config/autoload.php'
);

(new Orno\Loader\AutoloaderCollection)->addLoader('PSR-4', $autoloader)->register();

/**
 * -----------------------------------------------------------------------------
 * Build the dependency injection container
 * -----------------------------------------------------------------------------
 */
$container = include __DIR__ . '/../src/container.php';

/**
 * -----------------------------------------------------------------------------
 * Build routes and get a dispatcher
 * -----------------------------------------------------------------------------
 */
$dispatcher = include __DIR__ . '/../src/routes.php';

/**
 * -----------------------------------------------------------------------------
 * Grab a response from the dispatcher
 * -----------------------------------------------------------------------------
 */
$response = $dispatcher->dispatch(
    $container['Orno\Http\Request']->getMethod(),
    $container['Orno\Http\Request']->getPathInfo()
);

/**
 * -----------------------------------------------------------------------------
 * Handle response headers (see ../config/config.php)
 * -----------------------------------------------------------------------------
 */
$response->headers()->add([
    'Content-Type'                 => 'application/json',
    'Access-Control-Allow-Origin'  => $container['Orno\Config\Repository']['access_control']['allow_origin'],
    'Access-Control-Allow-Headers' => $container['Orno\Config\Repository']['access_control']['allow_headers']
]);

/**
 * -----------------------------------------------------------------------------
 * Send response to the browser
 * -----------------------------------------------------------------------------
 */
$response->send();
