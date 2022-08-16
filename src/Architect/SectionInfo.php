<?php

namespace Kirby\Architect;

use Kirby\Blueprint\Blueprint;
use Kirby\Blueprint\Column;
use Kirby\Blueprint\Node;
use Kirby\Blueprint\Tab;
use Kirby\Cms\ModelWithContent;
use Kirby\Field\Fields;
use Kirby\Section\Section;
use Kirby\Section\FieldsSection;

class SectionInfo extends ColumnInfo
{
    public function __construct(
        public Blueprint $blueprint,
        public Tab $tab,
        public Column $column,
        public Section $section,
    ) {
    }

	public function breadcrumb(ModelWithContent $model): array
    {
		return array_merge(parent::breadcrumb($model), [
			[
				'label' => is_a($this->section, FieldsSection::class) ? 'Fields' : $this->section->label?->render($model) ?? ucfirst($this->section->id),
				'link'  => self::url(),
			]
		]);
    }

	public function current(): Node
	{
		return $this->section;
	}

    public function dropdown(): array
    {
        $parent = $this->parent();

        $options = [
            [
                'icon' => 'angle-up',
                'text' => 'Insert before',
                'dialog' => $parent->url() . '/sections/create'
            ],
            [
                'icon' => 'angle-down',
                'text' => 'Insert after',
                'dialog' => $parent->url() . '/sections/create'
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
                'text' => 'Delete section',
                'dialog' => $this->url() . '/delete'
            ],
        ];

        if ($this->section::TYPE === 'fields') {
            array_unshift($options, [
                'icon'   => 'add',
                'text'   => 'Add field',
                'dialog' => $this->url() . '/fields/create'
            ], '-');
        }

        return $options;
    }

    public function element(ModelWithContent $model): array
    {
        $this->section->defaults();

        $render = [
            'id'   => $this->section->id,
            'type' => $this->section::TYPE,
            'url'  => $this->url()
        ];

        if (is_a($this->section, FieldsSection::class) === true) {
            return $render + [
                'label'  => 'Fields',
                'fields' => $this->fields($model, $this->section->fields)
            ];
        }

        return $render + [
            'label' => $this->section->label?->render($model)
        ];
    }

    public function fields(ModelWithContent $model, Fields $fields): array
    {
        return $fields->values(function ($field) use ($model) {
            $info = new FieldInfo(
                $this->blueprint,
                $this->tab,
                $this->column,
                $this->section,
                $field
            );

            return $info->element($model);
        });

    }

    public function main(ModelWithContent $model): array
    {
        $this->section->defaults();

        return parent::main($model) + [
            'section' => [
                'id'  => $this->section->id,
                'url' => $this->url()
            ]
        ];
    }

    public function parent(): ColumnInfo
    {
        return new ColumnInfo($this->blueprint, $this->tab, $this->column);
    }

    public static function pattern(): string
    {
        return parent::pattern() . '/sections/(:any)';
    }

    public function url(): string
    {
        return parent::url() . '/sections/' . $this->section->id;
    }
}
