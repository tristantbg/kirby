<?php

use Kirby\Architect\SectionInfo;

return [
    'pattern' => SectionInfo::pattern() . '/duplicate',
    'load'    => function (...$args) {
        $info = SectionInfo::find(...$args);

        return [
            'component' => 'k-form-dialog',
            'props' => [
                'fields' => [
                    'title' => [
                        'label' => 'Title',
                        'type'  => 'text',
                        'icon'  => 'title',
                    ]
                ]
            ],
        ];
    },
    'submit' => function (...$args) {
        $info = SectionInfo::find(...$args);

        return [];
    }
];
