<?php

return [
    /**
     * Bot configuration
     */
    'bot'      => [
        'name'    => env('PHP_TELEGRAM_BOT_NAME', ''),
        'api_key' => env('PHP_TELEGRAM_BOT_API_KEY', ''),
    ],

    /**
     * Database integration
     */
    'database' => [
        'enabled'    => true,
        'connection' => env('DB_CONNECTION_TELEGRAM', 'telegram'),
    ],

    'commands' => [
        'before'  => true,
        'paths'   => [
            // Custom command paths
        ],
        'configs' => [
            // Custom commands configs
        ],
    ],

    'admins'  => [
        // Admin ids
    ],

    /**
     * Request limiter
     */
    'limiter' => [
        'enabled'  => false,
        'interval' => 1,
    ],

    'upload_path'   => '',
    'download_path' => '',
];
