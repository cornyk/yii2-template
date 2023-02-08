<?php

$params = require __DIR__ . '/../app_params.php';
$db     = require __DIR__ . '/../items/db.php';
$redis  = require __DIR__ . '/../items/redis.php';
$log    = require __DIR__ . '/../items/log.php';
$router = require __DIR__ . '/../web_routes.php';
$view   = require __DIR__ . '/../items/view.php';
$i18n   = require __DIR__ . '/../items/i18n.php';
$queue  = require __DIR__ . '/../items/queue.php';

$config = [
    'id' => env('APP_NAME', 'app'),
    'timeZone' => env('APP_TIMEZONE', 'UTC'),
    'basePath' => dirname(__DIR__ . '/../../../'),
    'defaultRoute' => 'index',
    'viewPath' => $view['path'],
    'bootstrap' => [
        'log',
        'components\RequestLogEvent',
    ],
    'components' => [
        'request' => [
            'enableCsrfValidation' => false,
            'enableCookieValidation' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'error/error',
        ],
        'log' => $log,
        'db' => $db,
        'redis' => $redis,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => $router,
            'cache' => false,
        ],
        'view' => $view['component'],
        'i18n' => $i18n,
    ],
    'params' => $params,
];
$config['components'] = array_merge($config['components'], $queue['components']);

if (YII_ENV_DEV) require __DIR__ . '/../items/dev_tools.php';

return $config;
