<?php

/**
 * debug函数
 */
if (!function_exists('dd')) {
    function dd(...$arg)
    {
        if (APP_MODE_CLI) {
            var_dump($arg);
        } else {
            \yii\helpers\VarDumper::dump($arg, 10, true);
        }
        exit();
    }
}

/**
 * 自定义多语言翻译函数
 * @param $message
 * @param $lang
 * @param $params
 * @param $category
 * @return string
 */
if (!function_exists('trans')) {
    function trans($message, $lang = '', $params = [], $category = 'lang'): string
    {
        if (empty($lang)) {
            $lang = $GLOBALS['lang'] ?? 'en';
        }
        return Yii::t($category, $message, $params, $lang);
    }
}

/**
 * 判断字符串是否为json
 * @param $string
 * @return bool
 */
if (!function_exists('is_json')) {
    function is_json($string): bool
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
