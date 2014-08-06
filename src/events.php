<?php

$listen = new Orno\Event\Listener;

/**
 * -----------------------------------------------------------------------------
 * Logging events
 * -----------------------------------------------------------------------------
 */
$listen->on('log.debug', 'Api\Event\LogEvent::debug');
$listen->on('log.info', 'Api\Event\LogEvent::info');
$listen->on('log.notice', 'Api\Event\LogEvent::notice');
$listen->on('log.error', 'Api\Event\LogEvent::error');
$listen->on('log.critical', 'Api\Event\LogEvent::critical');
$listen->on('log.alert', 'Api\Event\LogEvent::alert');
$listen->on('log.emergency', 'Api\Event\LogEvent::emergency');





/**
 * -----------------------------------------------------------------------------
 * Return the listener to the bootstrap
 * -----------------------------------------------------------------------------
 */
return $listen;
