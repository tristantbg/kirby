<?php

use Kirby\Architect\FieldInfo;

return [
    'pattern' => FieldInfo::pattern() . '/duplicate',
    'load'    => function (...$args) {
        $info = FieldInfo::find(...$args);

        return [
            'component' => 'k-form-dialog',
            'props' => [
                'fields' => [
                    'name' => [
                        'label' => 'Name',
                        'type'  => 'slug',
                    ]
                ],
                'value' => [
                    'name' => $info->field->id,
                ]
            ],
        ];
    },
    'submit' => function (...$args) {
        return [];
    }
];
