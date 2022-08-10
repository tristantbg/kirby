<?php

namespace Kirby\Architect;

use Kirby\Blueprint\Blueprint;
use Kirby\Blueprint\Columns;
use Kirby\Blueprint\Tab;
use Kirby\Blueprint\Tabs;
use Kirby\Cms\ModelWithContent;

class BlueprintInfo extends Info
{
    public function __construct(
        public Blueprint $blueprint,
    ) {
        $this->tab = $this->blueprint->tab();
    }

    public function columns(ModelWithContent $model, Columns $columns): array
    {
        return $columns->values(function ($column) use ($model) {
            $info = new ColumnInfo(
                $this->blueprint,
                $this->tab,
                $column
            );

            return $info->element($model);
        });
    }

    public function dropdown(): array
    {
        return [
            [
                'text'   => 'Add tab',
                'icon'   => 'add',
                'dialog' => $this->url() . '/tabs/create',
            ],
            '-',
            [
                'text'   => 'Duplicate',
                'icon'   => 'copy',
                'dialog' => $this->url() . '/duplicate',
            ],
            '-',
            [
                'text'   => 'Delete',
                'icon'   => 'trash',
                'dialog' => $this->url() . '/delete',
            ]
        ];
    }

    public function element(ModelWithContent $model): array
    {
        $this->blueprint->defaults();

        return [
            'icon'     => $this->blueprint->image?->icon ?? 'page',
            'id'       => $this->blueprint->id,
            'label'    => $this->blueprint->label?->render($model),
            'url'      => $this->url(),
        ];
    }

    public function inspector(ModelWithContent $model): array
    {
        return [
            'title' => 'Blueprint: ' . $this->blueprint->label?->render($model),
            'type'  => 'blueprint'
        ] + parent::inspector($model);
    }

    public function main(ModelWithContent $model): array
    {
        // apply default values
        $this->blueprint->defaults();

        // lousy hack to get the main url in extended classes
        $blueprintInfo = new BlueprintInfo($this->blueprint);

        return [
            'active' => $this->url(),
            'id'     => $this->blueprint->id,
            'label'  => $this->blueprint->label?->render($model),
            'tab'    => $this->tab($model, $this->tab),
            'tabs'   => $this->tabs($model, $this->blueprint->tabs()),
            'url'    => $blueprintInfo->url()
        ];
    }

    public static function pattern(): string
    {
        return parent::pattern() . '/(:any)';
    }

    public function tab(ModelWithContent $model, ?Tab $tab = null): ?array
    {
        if ($tab === null) {
            return null;
        }

        $tabInfo = new TabInfo($this->blueprint, $tab);

        $this->tab->defaults();

        return [
            'id'      => $this->tab->id,
            'label'   => $this->tab->label?->render($model),
            'columns' => $this->columns($model, $this->tab->columns),
            'url'     => $tabInfo->url()
        ];
    }

    public function tabs(ModelWithContent $model, Tabs $tabs): array
    {
        return $tabs->values(function ($tab) use ($model) {
            $tabInfo = new TabInfo($this->blueprint, $tab);
            return $tabInfo->element($model);
        });
    }

    public function url(): string
    {
        return parent::url() . '/' . str_replace('/', '+', $this->blueprint->path());
    }
}
