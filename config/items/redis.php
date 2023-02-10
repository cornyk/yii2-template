<?php

return [
    'class' => 'yii\redis\Connection',
    'hostname' => env('REDIS_HOST', '127.0.0.1'),
    'port' => env('REDIS_PORT', '6379'),
    'password' => env('REDIS_PASSWORD'),
    'database' => env('REDIS_DB', '0'),
    'connectionTimeout' => env('REDIS_CONNECTION_TIMEOUT', 1),
];
