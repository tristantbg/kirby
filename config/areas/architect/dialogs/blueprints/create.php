<?php

return [
    'pattern' => 'blueprints/create',
    'load'    => function () {
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
                        'label'     => 'ID',
                        'type'      => 'slug',
                        'sync'      => 'title'
                    ],
                    'type' => [
                        'label'     => 'Type',
                        'type'      => 'radio',
                        'options'   => []
                    ]
                ],
                'submitButton' => t('create'),
                'value' => [
                    'type' => 'pages',
                    'id'   => ''
                ]
            ],
        ];
    },
    'submit' => function () {
    }
];
