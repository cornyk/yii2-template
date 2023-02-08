<?php

namespace app\controllers;

use app\commons\RespDef;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    public $layout = false;

    protected array $templateParams = [];

    public function beforeAction($action)
    {
        $this->setRequestId();
        return parent::beforeAction($action);
    }

    /**
     * 往模板注入参数
     * @param $key
     * @param $value
     */
    protected function assign($key, $value)
    {
        $this->templateParams[$key] = $value;
    }

    /**
     * 渲染模板
     * @param $templateName
     * @return string
     */
    protected function display($templateName): string
    {
        return $this->render($templateName, $this->templateParams);
    }

    /**
     * 正常返回
     * @param array|null $data
     * @param int|null $total
     * @return array
     */
    protected function sucJsonReturn(array $data = null, int $total = null): array
    {
        return $this->jsonReturn(RespDef::CODE_SUCCESS, RespDef::MSG_SUCCESS, $data, $total);
    }

    /**
     * json返回数据
     * @param $code
     * @param $msg
     * @param array|null $data
     * @param int|null $total
     * @return array
     */
    protected function jsonReturn($code, $msg, array $data = null, int $total = null): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = [];
        $result['code'] = (int)$code;
        $result['msg'] = $msg;
        if (isset($data)) $result['data'] = $data;
        if (isset($total)) $result['total'] = $total;
        return $result;
    }

    /**
     * 设置响应header头的请求ID
     * @return void
     */
    private function setRequestId()
    {
        Yii::$app->response->headers->add('Request-Id', $GLOBALS['requestId']);
    }
}
