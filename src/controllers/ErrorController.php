<?php

namespace app\controllers;

use components\RequestLogEvent;
use Yii;

class ErrorController extends BaseController
{
    /**
     * 处理异常
     * @return array|string
     */
    public function actionError()
    {
        RequestLogEvent::recordLog();

        $exception = Yii::$app->getErrorHandler()->exception;
        $statusCode = Yii::$app->response->getStatusCode();
        $exceptionName = Yii::$app->getErrorHandler()->getExceptionName($exception);
        $exceptionMessage = $exception->getMessage();

        if (Yii::$app->request->isAjax) {
            return $this->jsonReturn($statusCode, $exceptionMessage);
        }
        return $this->render('error', [
            'statusCode' => $statusCode,
            'exceptionName' => $exceptionName,
            'exceptionMessage' => $exceptionMessage,
        ]);
    }
}
