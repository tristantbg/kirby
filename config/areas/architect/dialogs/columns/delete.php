<?php

use Kirby\Architect\ColumnInfo;

return [
    'pattern' => ColumnInfo::pattern() . '/delete',
    'load'    => function (...$args) {
        $column = ColumnInfo::find(...$args);

        return [
            'component' => 'k-remove-dialog',
            'props'     => [
                'text' => 'Do you really want to delete the column?'
            ],
        ];
    },
    'submit' => function (...$args) {
        $column = ColumnInfo::find(...$args);

        return [
            'redirect' => $column->parent()->url()
        ];
    }
];
