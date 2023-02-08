<?php

namespace components;

use Yii;
use yii\i18n\MissingTranslationEvent;

/**
 * 多语言翻译监听事件
 */
class TranslationEvent
{
    public static function handleMissingTranslation(MissingTranslationEvent $event)
    {
        if (YII_DEBUG) {
            $event->translatedMessage = "@MISSING {$event->category}.{$event->message} FOR LANGUAGE {$event->language} @";
        }
        Yii::error("Missing translation: {$event->category}.{$event->message} , Language: {$event->language}", 'i18n');
    }
}
