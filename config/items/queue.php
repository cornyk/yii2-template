<?php

return [
    'bootstrap' => [
        'beanstalkdAlarm',
    ],
    'components' => [
        'beanstalkd' => [
            'class' => 'yii\queue\beanstalk\Queue',
            'serializer' => 'yii\queue\serializers\JsonSerializer',
            'host' => env('BEANSTALKD_HOST', '127.0.0.1'),
            'port' => env('BEANSTALKD_PORT', '11300'),
            'tube' => env('BEANSTALKD_TUBE', 'default'),
        ],
        'beanstalkdAlarm' => [
            'class' => 'yii\queue\beanstalk\Queue',
            'serializer' => 'yii\queue\serializers\JsonSerializer',
            'host' => env('BEANSTALKD_ALARM_HOST', '127.0.0.1'),
            'port' => env('BEANSTALKD_ALARM_PORT', '11300'),
            'tube' => env('BEANSTALKD_ALARM_TUBE', 'alarm'),
        ],
    ],
];
