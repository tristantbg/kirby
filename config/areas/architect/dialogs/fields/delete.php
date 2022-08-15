<?php

use Kirby\Architect\FieldInfo;

return [
    'pattern' => FieldInfo::pattern() . '/delete',
    'load'    => function (...$args) {
        $field = FieldInfo::find(...$args);

        return [
            'component' => 'k-remove-dialog',
            'props' => [
                'text' => 'Do you really want to delete the field?'
            ],
        ];
    },
    'submit' => function (...$args) {
        $field = FieldInfo::find(...$args);

        return [
            'redirect' => $field->parent()->url()
        ];
    }
];
