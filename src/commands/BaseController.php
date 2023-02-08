<?php

namespace app\commands;

use yii\console\Controller;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        $this->setRequestId();
        return parent::beforeAction($action);
    }

    /**
     * 设置命令行输出的请求ID
     * @return void
     */
    private function setRequestId()
    {
        echo 'Request-Id: ' . $GLOBALS['requestId'] . "\n\n";
    }
}
