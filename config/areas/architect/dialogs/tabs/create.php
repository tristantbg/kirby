<?php

use Kirby\Architect\BlueprintInfo;
use Kirby\Architect\TabInfo;

return [
    'pattern' => BlueprintInfo::pattern() . '/tabs/create',
    'load'    => function (string $blueprintId) {
        $info = BlueprintInfo::find($blueprintId);

        return [
            'component' => 'k-form-dialog',
            'props' => [
                'fields' => [
                    'title' => [
                        'label'     => 'Title',
                        'autofocus' => true,
                        'preselect' => true,
                        'type'      => 'text',
                    ],
                    'id' => [
                        'label' => 'ID',
                        'type'  => 'slug',
                        'sync'  => 'title',
                        'icon'  => false,
                    ]
                ],
                'size' => 'small',
                'value' => [
                    'id' => ''
                ]
            ],

        ];
    },
    'submit' => function (string $blueprintId) {
        $info = BlueprintInfo::find($blueprintId);

        return [
            'redirect' => $info->url()
        ];
    }
];
