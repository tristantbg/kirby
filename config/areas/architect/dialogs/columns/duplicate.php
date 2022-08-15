<?php

use Kirby\Architect\ColumnInfo;

return [
    'pattern' => ColumnInfo::pattern() . '/duplicate',
    'load'    => function (...$args) {
        $column = ColumnInfo::find(...$args);

        return [
            'component' => 'k-form-dialog',
            'props' => [
                'fields' => [
                    'name' => [
                        'label' => 'Name',
                        'type'  => 'text',
                    ],
                ],
                'value' => [
                    'name' => '',
                ]
            ],

        ];
    },
    'submit' => function (...$args) {
        return [];
    }
];
