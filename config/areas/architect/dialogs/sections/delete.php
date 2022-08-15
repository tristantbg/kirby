<?php

use Kirby\Architect\SectionInfo;

return [
    'pattern' => SectionInfo::pattern() . '/delete',
    'load'    => function (...$args) {
        $info = SectionInfo::find(...$args);

        return [
            'component' => 'k-remove-dialog',
            'props' => [
                'text' => 'Do you really want to delete the section?'
            ],
        ];
    },
    'submit' => function (...$args) {
        $info = SectionInfo::find(...$args);

        return [
            'redirect' => $info->parent()->url()
        ];
    }
];
