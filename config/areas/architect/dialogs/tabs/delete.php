<?php

use Kirby\Architect\TabInfo;

return [
    'pattern' => TabInfo::pattern() . '/delete',
    'load'    => function (...$args) {
        $info = TabInfo::find(...$args);

        return [
            'component' => 'k-remove-dialog',
            'props'     => [
                'text' => 'Do you really want to delete the tab?'
            ]
        ];
    },
    'submit' => function (...$args) {
        $info = TabInfo::find(...$args);

        return [
            'redirect' => $tab->parent()->url()
        ];
    }
];
