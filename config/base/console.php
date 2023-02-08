<?php

$params = require __DIR__ . '/../app_params.php';
$db     = require __DIR__ . '/../items/db.php';
$redis  = require __DIR__ . '/../items/redis.php';
$log    = require __DIR__ . '/../items/log.php';
$queue  = require __DIR__ . '/../items/queue.php';

$config = [
    'id' => env('APP_NAME', 'app') . '-console',
    'timeZone' => env('APP_TIMEZONE', 'UTC'),
    'basePath' => dirname(__DIR__ . '/../../../'),
    'bootstrap' => [
        'log',
        'components\RequestLogEvent',
    ],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'log' => $log,
        'db' => $db,
        'redis' => $redis,
    ],
    'params' => $params,
];
$config['bootstrap'] = array_merge($config['bootstrap'], $queue['bootstrap']);
$config['components'] = array_merge($config['components'], $queue['components']);

if (YII_ENV_DEV) require __DIR__ . '/../items/dev_tools.php';

return $config;
