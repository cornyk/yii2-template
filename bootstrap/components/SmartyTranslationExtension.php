<?php

namespace components;

use Yii;
use yii\smarty\Extension;

/**
 * Yii2 Smarty多语言翻译扩展
 *
 * 模板使用case：
 * <{trans text='This is a test content'}>
 */
class SmartyTranslationExtension extends Extension
{
    public function __construct($viewRenderer, $smarty)
    {
        parent::__construct($viewRenderer, $smarty);
        $smarty->registerPlugin('function', 'trans', [$this, 'trans']);
    }

    public function trans($args): string
    {
        $message = $args['text'] ?? '';
        if (empty($message)) {
            return '';
        }

        $lang = $args['lang'] ?? '';
        $params = $args['params'] ?? [];
        $category = $args['category'] ?? 'lang';
        if (empty($lang)) {
            $lang = $GLOBALS['lang'] ?? 'en';
        }
        return Yii::t($category, $message, $params, $lang);
    }
}
