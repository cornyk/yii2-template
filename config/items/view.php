<?php

return [
    'path' => __DIR__ . '/../../resources/views',
    'component' => [
        'renderers' => [
            /**
             * Smarty配置
             * Smarty3可通过继承SmartyBC并将php_handling设置为3可开启在模板中使用php短链
             * Smarty4移除了SmartyBC，而且禁止在模板里面直接使用php短链，因此只能通过使用扩展标签的方式使用多语言翻译
             *
             * 模板使用php短链使用多语言翻译
             * <?=trans('This is a test content')?>
             *
             * 模板使用多语言自定义标签case：
             * <{trans text='This is a test content'}>
             */
            'tpl' => [
                'class' => 'yii\smarty\ViewRenderer',
                'compilePath' => '@runtime/smarty/compile',
                'cachePath' => '@runtime/smarty/cache',
                'smartyClass' => '\SmartyBC', // 开启Smarty的php短链支持，Smarty3可用，Smarty4需要去掉此配置
                'extensionClass' => 'components\SmartyTranslationExtension',
                'options' => [
                    'left_delimiter' => '<{',
                    'right_delimiter' => '}>',
                    'php_handling' => 3, // 开启Smarty的php短链支持，Smarty3可用，Smarty4需要去掉此配置
                ],
            ],
        ],
    ],
];
