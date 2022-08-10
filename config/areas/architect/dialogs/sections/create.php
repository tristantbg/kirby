<?php

use Kirby\Architect\ColumnInfo;
use Kirby\Architect\SectionInfo;

return [
    'pattern' => ColumnInfo::pattern() . '/sections/create',
    'load'    => function (...$args) {
        $info = ColumnInfo::find(...$args);

        return [
            'component' => 'k-form-dialog',
            'props' => [
                'fields' => [
                    'id' => [
                        'label' => 'Section ID',
                        'type'  => 'slug',
                        'icon'  => false,
                        'width' => '1/2',
                    ],
                    'type' => [
                        'label'   => 'Type',
                        'type'    => 'select',
                        'empty'   => false,
                        'options' => [],
                        'width'   => '1/2',
                    ]
                ],
                'submitButton' => t('create'),
                'value' => [
                    'id'   => '',
                    'type' => ''
                ]
            ],
        ];
    },
    'submit' => function (...$args) {
        $info = ColumnInfo::find(...$args);

        return [
            'redirect' => $info->url()
        ];
    }
];
