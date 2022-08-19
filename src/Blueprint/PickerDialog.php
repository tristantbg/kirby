<?php

namespace Kirby\Blueprint;

use Kirby\Cms\Collection as Models;
use Kirby\Cms\ModelWithContent;
use Kirby\Table\TableColumns;

/**
 * Picker Dialog
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PickerDialog extends Node
{
	public const ITEMS = Items::class;

	public function __construct(
		public string $id,
		public TableColumns|null $columns = null,
		public EmptyState|null $empty = null,
		public BlueprintImage|null $image = null,
		public NodeText|null $info = null,
		public ItemsLayout|null $layout = null,
		public int $page = 1,
		public int $limit = 20,
		public bool $link = true,
		public int|null $max = null,
		public int|null $min = null,
		public bool $multiple = true,
		public string|null $query = null,
		public bool $search = true,
		public string|null $searchterm = null,
		public array $selected = [],
		public ItemsSize|null $size = null,
		public NodeText|null $text = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		if ($this->multiple === false) {
			$this->max = 1;
		}
	}

	public function applyPagination(Models $models): Models
	{
		return $models->paginate([
			'page'   => $this->page ?? 1,
			'limit'  => $this->limit,
			'method' => 'none'
		]);
	}

	public function applySearch(Models $models): Models
	{
		if ($this->search === false) {
			return $models;
		}

		if (empty($this->searchterm) === true) {
			return $models;
		}

		return $models->search($this->searchterm);
	}

	public function component(): string
	{
		return 'k-picker-dialog';
	}

	public function items(Models $models = null): Items
	{
		return new (static::ITEMS)(
			columns: $this->columns,
			empty: $this->empty,
			image: $this->image,
			info: $this->info,
			layout: $this->layout,
			models: $models,
			size: $this->size,
			text: $this->text
		);
	}

	public function models(ModelWithContent $model): Models
	{
		$models = $this->query !== null ? $model->query($this->query) : new Models;

		$models = $this->applySearch($models);
		$models = $this->applyPagination($models);

		return $models;
	}

	public function options(): array
	{
		return [
			'link'     => $this->link,
			'min'      => $this->min,
			'max'      => $this->max,
			'multiple' => $this->multiple,
			'search'   => $this->search,
		];
	}

	public function render(ModelWithContent $model): array
	{
		$this->defaults();

		$models = $this->models($model);
		$items  = $this->items($models)->defaults();

		return [
			'component' => $this->component(),
			'props' => [
				'items'      => $items->render($model),
				'options'    => $items->options($model) + $this->options(),
				'pagination' => $items->pagination(),
				'selected'   => $this->selected
			]
		];
	}

	public function submit(ModelWithContent $model, array $values = []): bool|array
	{
		$model->revision()->stage([$this->id => $values])->commit();
		return true;
	}
}
