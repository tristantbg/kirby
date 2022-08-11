<?php

namespace Kirby\Architect;

use Kirby\Blueprint\Blueprint;
use Kirby\Blueprint\Columns;
use Kirby\Blueprint\Node;
use Kirby\Blueprint\Tab;
use Kirby\Cms\ModelWithContent;

class TabInfo extends BlueprintInfo
{
    public function __construct(
        public Blueprint $blueprint,
        public Tab $tab,
    ) {
    }

	public function current(): Node
	{
		return $this->tab;
	}

    public function dropdown(): array
    {
        $parent = $this->parent();

        return [
            [
                'icon' => 'add',
                'text' => 'Add column',
                'dialog' => $this->url() . '/columns/create',
            ],
            '-',
            [
                'icon' => 'angle-left',
                'text' => 'Insert before',
                'dialog' => [
                    'url'   => $parent->url() . '/tabs/create',
                    'query' => [
                        'insert' => 'before',
                        'tab'    => $this->tab->id
                    ]
                ]
            ],
            [
                'icon' => 'angle-right',
                'text' => 'Insert after',
                'dialog' => [
                    'url'   => $parent->url() . '/tabs/create',
                    'query' => [
                        'insert' => 'after',
                        'tab'    => $this->tab->id
                    ]
                ]
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
                'text' => 'Delete tab',
                'dialog' => $this->url() . '/delete'
            ],
        ];
    }

    public function element(ModelWithContent $model): array
    {
        $this->tab->defaults();

        return [
            'id'    => $this->tab->id,
            'label' => $this->tab->label?->render($model),
            'url'   => $this->url()
        ];
    }

    public function parent(): BlueprintInfo
    {
        return new BlueprintInfo($this->blueprint);
    }

    public static function pattern(): string
    {
        return parent::pattern() . '/tabs/(:any)';
    }

    public function url(): string
    {
        return parent::url() . '/tabs/' . $this->tab->id;
    }
}
