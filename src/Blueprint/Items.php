<?php

namespace Kirby\Blueprint;

use Kirby\Cms\Collection as Models;
use Kirby\Cms\File;
use Kirby\Cms\ModelWithContent;
use Kirby\Cms\Page;
use Kirby\Cms\User;
use Kirby\Table\TableColumn;
use Kirby\Table\TableColumns;
use Kirby\Toolkit\A;

class Items extends Node
{
	public function __construct(
		public Models|null $models = null,
		public TableColumns|null $columns = null,
		public EmptyState|null $empty = null,
		public BlueprintImage|null $image = null,
		public NodeText|null $info = null,
		public ItemsLayout|null $layout = null,
		public ItemsSize|null $size = null,
		public NodeText|null $text = null,
	) {
	}

	/**
	 * Creates the full columns collection for the
	 * table layout, including the default columns
	 */
	public function columns(): TableColumns
	{
		$columns = new TableColumns();

		if ($this->image) {
			$columns->add(TableColumn::factory([
				'id'     => 'image',
				'label'  => '',
				'mobile' => true,
				'type'   => 'image',
				'width'  => 'var(--table-row-height)'
			]));
		}

		if ($this->text) {
			$columns->add(TableColumn::factory([
				'id'     => 'title',
				'label'  => 'title',
				'mobile' => true,
				'type'   => 'url',
			]));
		}

		if ($this->info) {
			$columns->add(TableColumn::factory([
				'id'    => 'info',
				'label' => 'info',
				'type'  => 'text',
			]));
		}

		if ($this->columns) {
			$columns->add($this->columns);
		}

		return $columns;
	}

	public function defaults(): static
	{
		$this->empty  ??= new EmptyState;
		$this->image  ??= new BlueprintImage;
		$this->layout ??= new ItemsLayout;
		$this->models ??= new Models;
		$this->size   ??= new ItemsSize;

		return parent::defaults();
	}

	/**
	 * Renders the response for a single item.
	 * This will be handed over to the Vue components
	 * to render the item in the section
	 */
	public function item(ModelWithContent $model, File|User|Page $item): array
	{
		$panel = $item->panel();

		$render = [
			'dragText' => $panel->dragText(),
			'id'       => $item->id(),
			'image'    => $this->itemImage($item)?->render($item),
			'info'     => $this->info?->render($item),
			'link'     => $panel->url(true),
			'text'     => $this->text?->render($item),
		];

		if ($this->layout?->value === 'table') {
			$render += $this->itemCells($model, $item);
		}

		return $render;
	}

	public function itemCells(ModelWithContent $model, ModelWithContent $item): array
	{
		// TODO: implement TableRows::render here
		return [];
	}

	public function itemImage(ModelWithContent $model): ?BlueprintImage
	{
		return $model->blueprint()->image()?->merge($this->image);
	}

	public function items(ModelWithContent $model, Models $models)
	{
		return A::map(
			$models->values(),
			fn ($item) => $this->item($model, $item)
		);
	}

	public function options(ModelWithContent $model): array
	{
		$this->defaults();

		return [
			'columns' => $this->columns?->render($model),
			'empty'   => $this->empty?->render($model),
			'layout'  => $this->layout?->render($model),
			'size'    => $this->size?->render($model),
		];
	}

	public function pagination(): ?array
	{
		if ($pagination = $this->models->pagination()) {
			return [
				'limit'  => $pagination->limit(),
				'offset' => $pagination->offset(),
				'page'   => $pagination->page(),
				'total'  => $pagination->total()
			];
		}

		return null;
	}

	public function render(ModelWithContent $model): array
	{
		$this->defaults();

		return $this->items($model, $this->models);
	}

}
