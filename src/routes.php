<?php

/**
 * Instantiate the router with access to an existing or new container
 */
use Orno\Di\Container;
use Orno\Di\ContainerInterface;
use Orno\Route\RouteCollection;

$route = new RouteCollection(
    (isset($container) && $container instanceof ContainerInterface) ? $container : new Container
);

/**
 * Define some routes
 */
$route->get('/', 'Api\Controller\MainController::version');






/**
 * Return a route dispatcher to the bootstrap
 */
return $route->getDispatcher();
