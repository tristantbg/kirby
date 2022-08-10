<?php

use Kirby\Architect\BlueprintInfo;
use Kirby\Architect\ColumnInfo;
use Kirby\Architect\FieldInfo;
use Kirby\Architect\SectionInfo;
use Kirby\Architect\TabInfo;

return [
    'blueprint' => [
        'pattern' => BlueprintInfo::pattern(),
        'options' => function (string $blueprintId) {
            return BlueprintInfo::find($blueprintId)->dropdown();
        }
    ],
    'blueprint.tab' => [
        'pattern' => TabInfo::pattern(),
        'options' => function (...$args) {
            return TabInfo::find(...$args)->dropdown();
        }
    ],
    'blueprint.column' => [
        'pattern' => ColumnInfo::pattern(),
        'options' => function (...$args) {
            return ColumnInfo::find(...$args)->dropdown();
        }
    ],
    'blueprint.section' => [
        'pattern' => SectionInfo::pattern(),
        'options' => function (...$args) {
            return SectionInfo::find(...$args)->dropdown();
        }
    ],
    'blueprint.field' => [
        'pattern' => FieldInfo::pattern(),
        'options' => function (...$args) {
            return FieldInfo::find(...$args)->dropdown();
        }
    ],
];
