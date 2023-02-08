<?php

namespace app\services;

use app\jobs\AlarmJob;
use Yii;

/**
 * 告警服务类
 */
class AlarmService
{
    const ALARM_LEVEL_ERROR = 'error';     // 告警等级 -> error
    const ALARM_LEVEL_WARNING = 'warning'; // 告警等级 -> warning
    const ALARM_LEVEL_INFO = 'info';       // 告警等级 -> info

    const ALARM_CHANNEL_DEVELOPER = 'developer'; // 告警通道 -> 开发
    const ALARM_CHANNEL_BUSINESS = 'business';   // 告警通道 -> 业务方
    const ALARM_CHANNEL_CONFIG_MAP = [ // 告警通道对应env的配置
        AlarmService::ALARM_CHANNEL_DEVELOPER => 'ALARM_CHANNEL_DEVELOPER_DINGTALK_URL',
        AlarmService::ALARM_CHANNEL_BUSINESS => 'ALARM_CHANNEL_BUSINESS_DINGTALK_URL',
    ];

    /**
     * 发送告警
     * @param string $message
     * @param string $level
     * @param string $channel
     * @return int
     */
    public static function sendAlarm(string $message, string $level = '', string $channel = ''): int
    {
        if (empty($level)) {
            $level = self::ALARM_LEVEL_ERROR;
        }
        if (empty($channel)) {
            $channel = self::ALARM_CHANNEL_DEVELOPER;
        }

        $alarmMessage = [
            'message' => $message,
            'level' => $level,
            'channel' => $channel,
            'time' => date('Y-m-d H:i:s'),
            'appMode' => APP_MODE_CLI ? 'console' : 'web',
            'requestId' => $GLOBALS['requestId'],
            'serverName' => gethostname(),
        ];

        $jobId = 0;
        try {
            $jobId = Yii::$app->beanstalkdAlarm->push(new AlarmJob($alarmMessage));
        } catch (\Throwable $e) {
            Yii::error('Alarm Error, alarm content: ' . json_encode($alarmMessage) . ' , error: ' . $e->getMessage());
        }
        return $jobId;
    }

    /**
     * 获取发送告警URL
     * @param $channel
     * @return string
     */
    public function getAlarmUrl($channel): string
    {
        return env(self::ALARM_CHANNEL_CONFIG_MAP[$channel] ?? AlarmService::ALARM_CHANNEL_DEVELOPER);
    }
}
