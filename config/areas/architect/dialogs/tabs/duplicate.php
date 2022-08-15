<?php

use Kirby\Architect\TabInfo;

return [
    'pattern' => TabInfo::pattern() . '/duplicate',
    'load'    => function (...$args) {
        $info = TabInfo::find(...$args);

        return [
            'component' => 'k-form-dialog',
            'props' => [
                'fields' => [
                    'title' => [
                        'label'     => 'Title',
                        'autofocus' => true,
                        'preselect' => true,
                        'type'      => 'text',
                        'required'  => true
                    ]
                ],
                'value' => [
                ]
            ],

        ];
    },
    'submit' => function (...$args) {
        $info = TabInfo::find(...$args);

        return [
            'redirect' => $info->url()
        ];
    }
];
