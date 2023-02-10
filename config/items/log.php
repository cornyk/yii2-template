<?php

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));
$date = date('Ymd');

$requestId = md5(time() . mt_rand(100000, 999999));
$GLOBALS['requestId'] = $requestId;

return [
    'traceLevel' => 0,
    'targets' => [
        // Web请求日志
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning', 'info'],
            'categories' => ['request'],
            'logFile' => "@runtime/logs/request_{$date}.log",
            'logVars' => [],
            'prefix' => function () use ($requestId) {
                $ip = Yii::$app->request->getUserIP();
                return "[$ip][$requestId]";
            },
        ],
        // 命令行运行日志
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning', 'info'],
            'categories' => ['console'],
            'logFile' => "@runtime/logs/console_{$date}.log",
            'logVars' => [],
            'prefix' => function () use ($requestId) {
                return "[console][$requestId]";
            },
        ],
        // SQL日志
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['info'],
            'categories' => ['yii\db\*'],
            'logFile' => "@runtime/logs/sql_{$date}.log",
            'logVars' => [],
            'prefix' => function () use ($requestId) {
                $ip = APP_MODE_CLI ? 'console' : Yii::$app->request->getUserIP();
                return "[$ip][$requestId]";
            },
        ],
        // SQL错误日志
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning'],
            'categories' => ['yii\db\*'],
            'logFile' => "@runtime/logs/sql_err_{$date}.log",
            'logVars' => [],
            'prefix' => function () use ($requestId) {
                $ip = APP_MODE_CLI ? 'console' : Yii::$app->request->getUserIP();
                return "[$ip][$requestId]";
            },
        ],
        // ERROR日志
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning'],
            'except' => ['yii\db\*', 'yii\web\HttpException:404', 'i18n', 'yii\i18n\*'],
            'logFile' => "@runtime/logs/error_{$date}.log",
            'logVars' => [],
            'prefix' => function () use ($requestId) {
                $ip = APP_MODE_CLI ? 'console' : Yii::$app->request->getUserIP();
                return "[$ip][$requestId]";
            },
        ],
        // INFO日志
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['info'],
            'except' => ['request', 'console', 'sendRequest', 'yii\db\*'],
            'logFile' => "@runtime/logs/info_{$date}.log",
            'logVars' => [],
            'prefix' => function () use ($requestId) {
                $ip = APP_MODE_CLI ? 'console' : Yii::$app->request->getUserIP();
                return "[$ip][$requestId]";
            },
        ],
        // 国际化错误日志
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning'],
            'categories' => ['i18n', 'yii\i18n\*'],
            'logFile' => "@runtime/logs/i18n_err_{$date}.log",
            'logVars' => [],
            'prefix' => function () use ($requestId) {
                $ip = APP_MODE_CLI ? 'console' : Yii::$app->request->getUserIP();
                return "[$ip][$requestId]";
            },
        ],
        // 发送请求日志
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['info'],
            'categories' => ['sendRequest'],
            'logFile' => "@runtime/logs/send_request_{$date}.log",
            'logVars' => [],
            'prefix' => function () use ($requestId) {
                $ip = APP_MODE_CLI ? 'console' : Yii::$app->request->getUserIP();
                return "[$ip][$requestId]";
            },
        ],
        // 发送请求错误日志
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning'],
            'categories' => ['sendRequest'],
            'logFile' => "@runtime/logs/send_request_err_{$date}.log",
            'logVars' => [],
            'prefix' => function () use ($requestId) {
                $ip = APP_MODE_CLI ? 'console' : Yii::$app->request->getUserIP();
                return "[$ip][$requestId]";
            },
        ],
    ],
];
