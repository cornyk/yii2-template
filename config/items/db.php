<?php

$dbConfig = [
    'class' => 'yii\db\Connection',

    // 主库配置
    'username' => env('DB_MASTER_USERNAME'),
    'password' => env('DB_MASTER_PASSWORD'),
    'charset' => env('DB_CHARSET', 'utf8'),
    'tablePrefix' => env('DB_TABLE_PREFIX', ''),
    'attributes' => [
        PDO::ATTR_TIMEOUT => (int)env('DB_MASTER_TIMEOUT', 1),
        PDO::ATTR_PERSISTENT => !APP_MODE_CLI,
    ],
    'dsn' => 'mysql:host=' . env('DB_MASTER_HOST', '127.0.0.1') . ':' . env('DB_MASTER_PORT', '3306') . ';dbname=' . env('DB_NAME'),
];
if (env('DB_SLAVE_AMOUNT', 0) > 0) {
    // 从库配置
    $dbConfig['slaveConfig'] = [
        'username' => env('DB_SLAVE_USERNAME'),
        'password' => env('DB_SLAVE_PASSWORD'),
        'charset' => env('DB_CHARSET', 'utf8'),
        'tablePrefix' => env('DB_TABLE_PREFIX', ''),
        'attributes' => [
            PDO::ATTR_TIMEOUT => (int)env('DB_SLAVE_TIMEOUT', 1),
            PDO::ATTR_PERSISTENT => !APP_MODE_CLI,
        ],
    ];

    // 从库服务器组配置
    for ($i = 1; $i <= env('DB_SLAVE_AMOUNT', 0); $i++) {
        $dbConfig['slaves'][] = [
            'dsn' => 'mysql:host=' . env('DB_SLAVE_HOST_' . $i) . ':' . env('DB_SLAVE_PORT_' . $i) . ';dbname=' . env('DB_NAME'),
        ];
    }
}

return $dbConfig;
