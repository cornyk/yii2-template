<?php

return [
    'translations' => [
        'lang*' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => __DIR__ . '/../../resources/lang',
            'sourceLanguage' => 'en',
            'fileMap' => [
                'lang' => 'lang.php',
            ],
            'on missingTranslation' => ['components\TranslationEvent', 'handleMissingTranslation'],
        ],
    ],
];
