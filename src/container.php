<?php

use Orno\Config\Repository as Config;
use Orno\Config\File\ArrayFileLoader;

$container = new Orno\Di\Container;

/**
 * -----------------------------------------------------------------------------
 * All container entries should be defined here
 * -----------------------------------------------------------------------------
 */
$container->add('Api\Controller\MainController')
          ->withArgument('Orno\Config\Repository')
          ->withArgument('Orno\Event\Publisher');





/**
 * -----------------------------------------------------------------------------
 * Config definitions
 * -----------------------------------------------------------------------------
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

/**
 * -----------------------------------------------------------------------------
 * Request and response
 * -----------------------------------------------------------------------------
 */
$container->add('Orno\Http\Request', function () {
    return Orno\Http\Request::createFromGlobals();
});

/**
 * -----------------------------------------------------------------------------
 * Logging
 * -----------------------------------------------------------------------------
 */
$container->singleton('Monolog\Logger', function () use ($container) {
    $logger = new Monolog\Logger($container->get('Orno\Config\Repository')['application'] . ' Log');
    $logger->pushHandler(
        new Monolog\Handler\StreamHandler(__DIR__ . '/../log/api.log')
    );

    return $logger;
});

/**
 * -----------------------------------------------------------------------------
 * Events
 * -----------------------------------------------------------------------------
 */
$container->add('Orno\Event\Listener', include __DIR__ . '/../src/events.php');

$container->add('Orno\Event\Publisher', function () use ($container) {
    return (new Orno\Event\Publisher($container))->setListener($container->get('Orno\Event\Listener'));
});

/**
 * -----------------------------------------------------------------------------
 * Return the container to the bootstrap
 * -----------------------------------------------------------------------------
 */
return $container;
