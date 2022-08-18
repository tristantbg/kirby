<?php

namespace Kirby\Blueprint;

use Kirby\Cms\File;
use Kirby\Cms\ModelWithContent;
use Kirby\Cms\Page;
use Kirby\Cms\User;
use Kirby\Table\TableColumn;
use Kirby\Table\TableColumns;

class PagesItems extends Items
{
	/**
	 * Creates the full columns collection for the
	 * table layout, including the default columns
	 */
	public function columns(): TableColumns
	{
		$columns = parent::columns();

		$columns->add(TableColumn::factory([
			'id'     => 'flag',
			'label'  => '',
			'mobile' => true,
			'type'   => 'flag',
			'width'  => 'var(--table-row-height)'
		]));

		return $columns;
	}

	public function defaults(): static
	{
		$this->empty ??= new EmptyState(
			icon: new NodeIcon('page'),
			text: new NodeText(['*' => 'pages.empty'])
		);

		$this->image ??= new PageBlueprintImage;
		$this->text  ??= new NodeText(['en' => '{{ page.title }}']);

		return parent::defaults();
	}

	/**
	 * Renders the response for a single item.
	 * This will be handed over to the Vue components
	 * to render the item in the section
	 *
	 * @param \Kirby\Cms\Page $item
	 */
	public function item(ModelWithContent $model, File|User|Page $item): array
	{
		$permissions = $item->permissions();

		return parent::item($model, $item) + [
			'parent'      => $item->parentId(),
			'permissions' => [
				'sort'         => $permissions->can('sort'),
				'changeStatus' => $permissions->can('changeStatus'),
			],
			'status'   => $item->status(),
			'template' => $item->intendedTemplate()->name()
		];
	}
}
