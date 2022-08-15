<?php

use Kirby\Architect\BlueprintInfo;

return [
    'pattern' => BlueprintInfo::pattern() . '/duplicate',
    'load'    => function (string $blueprintPath) {
        $info = BlueprintInfo::find($blueprintPath);

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
                    'title' => 'Copy'
                ]
            ],

        ];
    },
    'submit' => function (string $blueprintPath) {
        $info = BlueprintInfo::find($blueprintPath);

        return [
            'redirect' => $info->url()
        ];
    }
];
