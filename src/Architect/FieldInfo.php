<?php

namespace Kirby\Architect;

use Kirby\Blueprint\Blueprint;
use Kirby\Blueprint\Column;
use Kirby\Blueprint\Node;
use Kirby\Blueprint\Tab;
use Kirby\Cms\ModelWithContent;
use Kirby\Field\Field;
use Kirby\Section\Section;

class FieldInfo extends SectionInfo
{
    public function __construct(
        public Blueprint $blueprint,
        public Tab $tab,
        public Column $column,
        public Section $section,
        public Field $field,
    ) {
    }

	public function current(): Node
	{
		return $this->field;
	}

    public function dropdown(): array
    {
        $parent = $this->parent();

        return [
            [
                'icon' => 'angle-up',
                'text' => 'Insert before',
                'dialog' => $parent->url() . '/fields/create'
            ],
            [
                'icon' => 'angle-down',
                'text' => 'Insert after',
                'dialog' => $parent->url() . '/fields/create'
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
                'text' => 'Delete field',
                'dialog' => $this->url() . '/delete'
            ],
        ];
    }

    public function element(ModelWithContent $model): array
    {
        $this->field->defaults();

        $render = [
            'id'     => $this->field->id,
            'label'  => ucfirst($this->field->id),
            'type'   => $this->field::TYPE,
            'width'  => $this->field->width?->render($model),
            'url'    => $this->url()
        ];

        if (property_exists($this->field, 'label') === true) {
            $render['label'] = $this->field->label?->render($model);
        }

        return $render;
    }

    public function main(ModelWithContent $model): array
    {
        $this->field->defaults();

        return parent::main($model) + [
            'field' => [
                'id'  => $this->field->id,
                'url' => $this->url()
            ]
        ];
    }

    public function parent(): SectionInfo
    {
        return new SectionInfo($this->blueprint, $this->tab, $this->column, $this->section);
    }

    public static function pattern(): string
    {
        return parent::pattern() . '/fields/(:any)';
    }

    public function url(): string
    {
        return parent::url() . '/fields/' . $this->field->id;
    }
}
