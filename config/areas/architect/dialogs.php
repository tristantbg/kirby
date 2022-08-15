<?php

return [
    'blueprint.create'             => require_once __DIR__ . '/dialogs/blueprints/create.php',
    'blueprint.delete'             => require_once __DIR__ . '/dialogs/blueprints/delete.php',
    'blueprint.duplicate'          => require_once __DIR__ . '/dialogs/blueprints/duplicate.php',

    'blueprint.tab.create'         => require_once __DIR__ . '/dialogs/tabs/create.php',
    'blueprint.tab.duplicate'      => require_once __DIR__ . '/dialogs/tabs/duplicate.php',
    'blueprint.tab.delete'         => require_once __DIR__ . '/dialogs/tabs/delete.php',

    'blueprint.column.create'      => require_once __DIR__ . '/dialogs/columns/create.php',
    'blueprint.column.duplicate'   => require_once __DIR__ . '/dialogs/columns/duplicate.php',
    'blueprint.column.delete'      => require_once __DIR__ . '/dialogs/columns/delete.php',

    'blueprint.section.create'     => require_once __DIR__ . '/dialogs/sections/create.php',
    'blueprint.section.duplicate'  => require_once __DIR__ . '/dialogs/sections/duplicate.php',
    'blueprint.section.delete'     => require_once __DIR__ . '/dialogs/sections/delete.php',

    'blueprint.field.create'       => require_once __DIR__ . '/dialogs/fields/create.php',
    'blueprint.field.duplicate'    => require_once __DIR__ . '/dialogs/fields/duplicate.php',
    'blueprint.field.delete'       => require_once __DIR__ . '/dialogs/fields/delete.php',
];
