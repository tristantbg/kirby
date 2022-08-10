<?php

use Kirby\Architect\BlueprintInfo;
use Kirby\Architect\ColumnInfo;
use Kirby\Architect\FieldInfo;
use Kirby\Architect\SectionInfo;
use Kirby\Architect\TabInfo;
use Kirby\Panel\Panel;

return [
    'blueprints' => [
        'pattern' => 'blueprints',
        'action'  => function () {
            Panel::go('blueprints/site');
        }
    ],
    'blueprint' => [
        'pattern' => BlueprintInfo::pattern(),
        'action'  => function (string $blueprintPath) {
            return BlueprintInfo::find($blueprintPath)->view();
        }
    ],
    'blueprint.tab' => [
        'pattern' => TabInfo::pattern(),
        'action'  => function (string $blueprintPath, string $tabId) {
            return TabInfo::find($blueprintPath, $tabId)->view();
        }
    ],
    'blueprint.column' => [
        'pattern' => ColumnInfo::pattern(),
        'action'  => function (string $blueprintPath, string $tabId, string $columnId) {
            return ColumnInfo::find($blueprintPath, $tabId, $columnId)->view();
        }
    ],
    'blueprint.section' => [
        'pattern' => SectionInfo::pattern(),
        'action'  => function (string $blueprintPath, string $tabId, string $columnId, string $sectionId) {
            return SectionInfo::find($blueprintPath, $tabId, $columnId, $sectionId)->view();
        }
    ],
    'blueprint.field' => [
        'pattern' => FieldInfo::pattern(),
        'action'  => function (string $blueprintPath, string $tabId, string $columnId, string $sectionId, string $fieldId) {
            return FieldInfo::find($blueprintPath, $tabId, $columnId, $sectionId, $fieldId)->view();
        }
    ],
];
