<?php

namespace Kirby\Architect;

use Kirby\Blueprint\Blueprint;
use Kirby\Blueprint\Column;
use Kirby\Blueprint\Tab;
use Kirby\Cms\ModelWithContent;
use Kirby\Section\Sections;

class ColumnInfo extends TabInfo
{
    public function __construct(
        public Blueprint $blueprint,
        public Tab $tab,
        public Column $column,
    ) {
    }

    public function dropdown(): array
    {
        $parent = $this->parent();

        return [
            [
                'icon' => 'add',
                'text' => 'Add section',
                'dialog' => $this->url() . '/sections/create'
            ],
            '-',
            [
                'icon' => 'angle-left',
                'text' => 'Insert before',
                'dialog' => $parent->url() . '/columns/create'
            ],
            [
                'icon' => 'angle-right',
                'text' => 'Insert after',
                'dialog' => $parent->url() . '/columns/create'
            ],
            '-',
            [
                'icon' => 'copy',
                'text' => 'Duplicate',
                'dialog' => $this->url() . '/duplicate'
            ],
            '-',
            [
                'icon' => 'trash',
                'text' => 'Delete column',
                'dialog' => $this->url() . '/delete'
            ],
        ];
    }

    public function element(ModelWithContent $model): array
    {
        $this->column->defaults();

        return [
            'id'       => $this->column->id,
            'sections' => $this->sections($model, $this->column->sections),
            'url'      => $this->url(),
            'width'    => $this->column->width->render($model),
        ];
    }

    public function inspector(ModelWithContent $model): array
    {
		return $this->column::inspector()->render($model);
    }

    public function main(ModelWithContent $model): array
    {
        $this->column->defaults();

        return parent::main($model) + [
            'column' => [
                'id'  => $this->column->id,
                'url' => $this->url()
            ]
        ];
    }

    public function parent(): TabInfo
    {
        return new TabInfo($this->blueprint, $this->tab);
    }

    public static function pattern(): string
    {
        return parent::pattern() . '/columns/(:any)';
    }

    public function sections(ModelWithContent $model, Sections $sections): array
    {
        return $sections->values(function ($section) use ($model) {
            $info = new SectionInfo(
                $this->blueprint,
                $this->tab,
                $this->column,
                $section
            );

            return $info->element($model);
        });

    }

    public function url(): string
    {
        return parent::url() . '/columns/' . $this->column->id;
    }
}
