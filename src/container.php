<?php

use Orno\Config\Repository as Config;
use Orno\Config\File\ArrayFileLoader;

$container = new Orno\Di\Container;

/**
 * All container entries should be defined here
 */
$container->add('Api\Controller\MainController')
          ->withArgument('Orno\Config\Repository');





/**
 * Component specific container definitions
 */
$container->singleton('Orno\Config\Repository', function () {
    $config = new Config;

    // list of config files to be included by default
    $config->addFileLoader(new ArrayFileLoader(__DIR__ . '/../config/config.php'));

    // overwrite config values with the env specific equivalents
    if (defined('API_ENV') && is_readable(__DIR__ . '/../config/' . API_ENV . '/config.php')) {
        $config->addFileLoader(new ArrayFileLoader(__DIR__ . '/../config/' . API_ENV . '/config.php'));
    }

    return $config;
});

$container->add('Orno\Http\Request', function () {
    return Orno\Http\Request::createFromGlobals();
});

/**
 * Return the container to the bootstrap
 */
return $container;
