<?php

namespace Api\Controller;

use Orno\Config\Repository as Config;
use Orno\Http\JsonResponse;
use Orno\Http\Request;

class MainController
{
    /**
     * Constructor
     *
     * @param \Orno\Config\Repository $config [description]
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Version controller responds to /
     *
     * @param  \Orno\Http\Request $request
     * @return \Orno\Http\JsonResponse
     */
    public function version(Request $request)
    {
        return new JsonResponse([
            'application' => $this->config['application'],
            'version'     => $this->config['version'],
            'author'      => $this->config['author']
        ]);
    }
}
