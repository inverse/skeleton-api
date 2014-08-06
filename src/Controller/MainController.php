<?php

namespace Api\Controller;

use Orno\Config\Repository as Config;
use Orno\Event\PublisherInterface as Event;
use Orno\Http\JsonResponse;
use Orno\Http\Request;

class MainController
{
    /**
     * @var \Orno\Config\Repository
     */
    protected $config;

    /**
     * @var \Orno\Event\Publisher
     */
    protected $event;

    /**
     * Constructor
     *
     * @param \Orno\Config\Repository $config
     * @param \Orno\Event\Publisher   $event
     */
    public function __construct(Config $config, Event $event)
    {
        $this->config = $config;
        $this->event  = $event;
    }

    /**
     * Version controller responds to /
     *
     * @param  \Orno\Http\Request $request
     * @return \Orno\Http\JsonResponse
     */
    public function version(Request $request)
    {
        $this->event->publish('log.info', [
            sprintf('%s dispatched for route %s', __METHOD__, $request->getPathInfo())
        ]);

        return new JsonResponse([
            'application' => $this->config['application'],
            'version'     => $this->config['version'],
            'author'      => $this->config['author']
        ]);
    }
}
