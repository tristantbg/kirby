<?php

namespace Kirby\Architect;

use Kirby\Blueprint\Node;
use Kirby\Blueprint\Blueprint;
use Kirby\Blueprint\Column;
use Kirby\Blueprint\Tab;
use Kirby\Cms\ModelWithContent;
use Kirby\Field\Field;
use Kirby\Section\Section;

abstract class Info
{
	public function breadcrumb(ModelWithContent $model): array
    {
		// apply default values
        $this->blueprint->defaults();

		return [];
    }

    public function component(ModelWithContent $model): string
    {
        return 'k-architect-view';
    }

	abstract public function current(): Node;

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
		$current = $this->current();

		return $current::inspector()->fill($model, $current)->render($model);
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
			'breadcrumb' => $this->breadcrumb($model),
            'component'  => $this->component($model),
            'props'      => [
                'blueprint' => fn () => $this->main($model),
                'inspector' => fn () => $this->inspector($model),
                'menu'      => fn () => $this->menu($model),
            ]
        ];
    }

}
