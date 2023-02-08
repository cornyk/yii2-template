<?php

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/constants.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/functions.php';

$config = require __DIR__ . '/../config/base/web.php';
$app = (new yii\web\Application($config));

return $app;
