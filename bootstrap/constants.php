<?php

defined('YII_DEBUG') or define('YII_DEBUG', filter_var(env('APP_DEBUG', false), FILTER_VALIDATE_BOOLEAN));
defined('YII_ENV') or define('YII_ENV', env('APP_ENV', 'prod'));
defined('APP_MODE_CLI') or define('APP_MODE_CLI', php_sapi_name() == 'cli');
