<?php

use Kirby\Architect\BlueprintInfo;

return [
    'pattern' => BlueprintInfo::pattern() . '/delete',
    'load'    => function (string $blueprintPath) {
        $info = BlueprintInfo::find($blueprintPath);

        return [
            'component' => 'k-remove-dialog',
            'props' => [
                'text' => 'Do you really want to delete this blueprint?'
            ]
        ];
    },
    'submit' => function (string $blueprintPath) {
        $info = BlueprintInfo::find($blueprintPath);

        return [
            'redirect' => '/blueprints'
        ];
    }
];
