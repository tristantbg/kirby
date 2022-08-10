<?php

namespace Kirby\Architect;

use Kirby\Blueprint\Blueprint;
use Kirby\Blueprint\Column;
use Kirby\Blueprint\Tab;
use Kirby\Cms\ModelWithContent;
use Kirby\Field\Field;
use Kirby\Section\Section;

abstract class Info
{
    public function component(ModelWithContent $model): string
    {
        return 'k-architect-view';
    }

    public function dropdown(): array
    {
        return [];
    }

    public function element(ModelWithContent $model): array
    {
        return [];
    }

    public static function find(
        string $blueprintPath,
        string $tabId = null,
        string $columnId = null,
        string $sectionId = null,
        string $fieldId = null
    ) {
        $blueprint = Blueprint::find($blueprintPath);

        if ($tabId === null) {
            return new BlueprintInfo(
                $blueprint
            );
        }

        $tab = Tab::find($blueprint, $tabId);

        if ($columnId === null) {
            return new TabInfo(
                $blueprint,
                $tab,
            );
        }

        $column = Column::find($blueprint, $tab, $columnId);

        if ($sectionId === null) {
            return new ColumnInfo(
                $blueprint,
                $tab,
                $column,
            );
        }

        $section = Section::find($blueprint, $tab, $column, $sectionId);

        if ($fieldId === null) {
            return new SectionInfo(
                $blueprint,
                $tab,
                $column,
                $section,
            );
        }

        $field = Field::find($blueprint, $tab, $column, $section, $fieldId);

        return new FieldInfo(
            $blueprint,
            $tab,
            $column,
            $section,
            $field
        );
    }

    public function inspector(ModelWithContent $model): array
    {
        return [
            'options'  => $this->url(),
            'api'      => $this->url(),
            'sections' => [],
            'title'    => 'Inspector',
            'type'     => 'inspector',
            'value'    => []
        ];
    }

    public function main(ModelWithContent $model): array
    {
        return [];
    }

    public function menu(ModelWithContent $model): array
    {
        return (new Menu)->render();
    }

    public function parent(): Info
    {
        return new Info;
    }

    public static function pattern(): string
    {
        return '/blueprints';
    }

    public function url(): string
    {
        return '/blueprints';
    }

    public function view(ModelWithContent $model = null): array
    {
        $model ??= site();

        return [
            'component' => $this->component($model),
            'props'     => [
                'blueprint' => $this->main($model),
                'inspector' => $this->inspector($model),
                'menu'      => $this->menu($model),
            ]
        ];
    }

}
