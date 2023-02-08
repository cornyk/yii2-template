<?php

namespace components;

use Yii;
use yii\base\Application;
use yii\base\Event;

/**
 * 请求日志记录监听事件
 */
class RequestLogEvent extends Event
{
    public function init()
    {
        Yii::$app->on(Application::EVENT_AFTER_REQUEST, function ($event) {
            self::recordLog();
        });
    }

    public static function recordLog()
    {
        if (APP_MODE_CLI) {
            $requestMessage = "COMMAND: php " . implode(' ', $_SERVER['argv']);
            Yii::info($requestMessage, 'console');
        } else {
            $url = Yii::$app->request->getUrl();
            $statusCode = Yii::$app->response->getStatusCode();
            $method = Yii::$app->request->getMethod();
            $bodyParams = http_build_query(Yii::$app->request->getBodyParams());
            $rawBody = preg_replace('/\s(?=\s)/', '', preg_replace("/(\r\n|\n|\r|\t)/i", ' ', Yii::$app->request->getRawBody()));;
            $headers = json_encode(Yii::$app->request->getHeaders()->toArray());

            $requestMessage = "URL: {$url} , STATUS_CODE: {$statusCode} , METHOD: {$method} , BODY_PARAMS: {$bodyParams} , RAW_BODY: {$rawBody} , HEADERS: {$headers}";
            Yii::info($requestMessage, 'request');
        }
    }
}
