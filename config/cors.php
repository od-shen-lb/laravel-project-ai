<?php

return [
    'paths'                    => ['*'],
    'allowed_methods'          => ['*'],
    'allowed_origins'          => explode(',', env('CORS_ALLOW_DOMAINS', 'http://localhost')),
    'allowed_origins_patterns' => [],
    'allowed_headers'          => [
        'Authorization',
        'Content-Type',
        'X-Requested-With',
    ],
    'exposed_headers'          => [],
    'max_age'                  => 60,
    'supports_credentials'     => true,
];
