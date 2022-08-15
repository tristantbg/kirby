<?php

use Kirby\Architect\TabInfo;

return [
    'pattern' => TabInfo::pattern() . '/columns/create',
    'load'    => function (string $blueprintPath, string $tabId) {
        return [
            'component' => 'k-form-dialog',
            'props' => [
                'fields' => [
                    'id' => [
                        'label' => 'Column ID',
                        'type'  => 'slug',
                        'icon'  => false,
                        'width' => '3/4'
                    ],
                    'width' => [
                        'label'   => 'Width',
                        'type'    => 'select',
                        'empty'   => false,
                        'options' => [],
                        'width'   => '1/4'
                    ]
                ],
                'submitButton' => t('create'),
                'value' => [
                    'id'    => '',
                    'width' => '1/1'
                ]
            ],

        ];
    },
    'submit' => function (string $blueprintPath, string $tabId) {
    }
];
