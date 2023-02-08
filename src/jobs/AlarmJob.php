<?php

namespace app\jobs;

use app\services\AlarmService;
use app\utils\RequestUtil;
use Yii;
use yii\base\BaseObject;
use yii\queue\JobInterface;

class AlarmJob extends BaseObject implements JobInterface
{
    public string $message;
    public string $level;
    public string $channel;
    public string $time;
    public string $appMode;
    public string $requestId;
    public string $serverName;

    /**
     * 处理队列任务
     * @param $queue
     * @return void
     */
    public function execute($queue)
    {
        $systemEnv = env('APP_ENV', 'prod');
        $alarmUrl = (new AlarmService())->getAlarmUrl($this->channel);
        $alarmData = [
            'msgtype' => 'markdown',
            'markdown' => [
                'title' => '系统告警',
                'text' => "### 系统告警\n\n告警机器：{$this->serverName}\n\n告警时间：{$this->time}\n\n系统环境：{$systemEnv}\n\n告警等级：{$this->level}\n\n运行模式：{$this->appMode}\n\n请求ID：{$this->requestId}\n\n告警内容：{$this->message}\n",
            ],
        ];
        if ($this->level != AlarmService::ALARM_LEVEL_INFO) {
            $alarmData['at']['isAtAll'] = true;
        }

        $requestData = [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => $alarmData,
        ];
        $resultJson = RequestUtil::send($alarmUrl, 'POST', $requestData);
        $result = json_decode($resultJson, true);
        $resultErrCode = $result['errcode'] ?? -1;
        if ($resultErrCode != 0) {
            Yii::error('Send Alarm Error, Reason: ' . $resultJson . ' , AlarmData: ' . json_encode($alarmData, JSON_UNESCAPED_UNICODE ));
        }
    }
}
