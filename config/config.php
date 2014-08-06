<?php

return [
    /**
     * Standard application information
     */
    'application' => 'Orno Skeleton API Application',
    'version'     => 1,
    'author'      => [
        'name'  => 'Phil Bennett',
        'email' => 'philipobenito@gmail.com'
    ],

    /**
     * CORS (see http://en.wikipedia.org/wiki/Cross-origin_resource_sharing)
     */
    'access_control' => [
        'allow_origin'  => '*',
        'allow_headers' => 'origin, x-csrftoken, content-type, accept, authorization'
    ]
];
