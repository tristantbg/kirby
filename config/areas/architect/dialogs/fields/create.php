<?php

use Kirby\Architect\FieldInfo;
use Kirby\Architect\SectionInfo;

return [
    'pattern' => SectionInfo::pattern() . '/fields/create',
    'load'    => function (...$args) {
        $section = SectionInfo::find(...$args);

        return [
            'component' => 'k-form-dialog',
            'props' => [
                'fields' => [
                    'id' => [
                        'label' => 'Field ID',
                        'type'  => 'slug',
                        'icon'  => false
                    ],
                    'type' => [
                        'label'   => 'Type',
                        'type'    => 'select',
                        'empty'   => false,
                        'options' => [],
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
    }
];
