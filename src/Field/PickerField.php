<?php

namespace Kirby\Field;

use Kirby\Blueprint\BlueprintImage;
use Kirby\Blueprint\EmptyState;
use Kirby\Blueprint\Items;
use Kirby\Blueprint\ItemsLayout;
use Kirby\Blueprint\ItemsSize;
use Kirby\Blueprint\NodeModel;
use Kirby\Blueprint\NodeText;
use Kirby\Blueprint\PickerDialog;
use Kirby\Cms\Collection as Models;
use Kirby\Cms\ModelWithContent;
use Kirby\Cms\File;
use Kirby\Cms\Page;
use Kirby\Cms\Site;
use Kirby\Cms\User;
use Kirby\Table\TableColumns;
use Kirby\Value\YamlValue;

/**
 * Picker field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PickerField extends InputField
{
	public const DIALOG = PickerDialog::class;
	public const ITEMS  = Items::class;
	public const TYPE   = 'picker';
	public YamlValue $value;

	public function __construct(
		public string $id,
		public TableColumns|null $columns = null,
		public array|null $default = null,
		public EmptyState|null $empty = null,
		public BlueprintImage|null $image = null,
		public NodeText|null $info = null,
		public ItemsLayout|null $layout = null,
		public int $limit = 20,
		public bool $link = true,
		public int|null $max = null,
		public int|null $min = null,
		public bool $multiple = true,
		public string|null $query = null,
		public bool $search = true,
		public ItemsSize|null $size = null,
		public NodeText|null $text = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		if ($this->multiple === false) {
			$this->max = 1;
		}

		$this->value = new YamlValue(
			max: $this->max,
			min: $this->min,
			required: $this->required
		);
	}

	public function dialogs(ModelWithContent $model): array
	{
		return [
			[
				'pattern' => '/',
				'load' => function (array $query = []) use ($model) {
					return $this->picker($model, $query)->render($model);
				},
				'submit' => function () use ($model) {
					return $this->picker($model)->submit($model, get());
				}
			]
		];
	}

	public function items(Models $models = null): Items
	{
		return new (static::ITEMS)(
			columns: $this->columns,
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
		return new Models;
	}

	public function picker(ModelWithContent $model, array $query = []): PickerDialog
	{
		return new (static::DIALOG)(
			id: $this->id,
			columns: $this->columns,
			empty: $this->empty,
			image: $this->image,
			info: $this->info,
			layout: $this->layout,
			limit: $this->limit,
			link: $this->link,
			max: $this->max,
			min: $this->min,
			multiple: $this->multiple,
			page: $query['page'] ?? 1,
			query: $this->query,
			search: $this->search,
			searchterm: $query['searchterm'] ?? null,
			selected: $this->selected($model),
			size: $this->size,
			text: $this->text
		);
	}

	public function render(ModelWithContent $model): array
	{
		$items = $this->items()->defaults();

		return parent::render($model) + [
			'empty'    => $items->empty?->render($model),
			'layout'   => $items->layout?->render($model),
			'multiple' => $this->multiple,
		];
	}

	public function routes(ModelWithContent $model): array
	{
		return [
			[
				'pattern' => '/',
				'action'  => function (array $query = []) use ($model) {
					$models = $this->models($model)->paginate(10);
					$items  = $this->items($models)->defaults();

					return $items->collection($model);
				}
			],
			[
				'pattern' => '/items/(:all)',
				'method'  => 'DELETE',
				'action'  => function (string $itemId) use ($model) {

					$revision = $model->revision();
					$value    = $revision->value($this->id);

					// remove the itemId from the value array
					$value = array_filter($value, fn ($valueId) => $itemId !== $valueId);

					// update the field in the revision
					$revision->stage([$this->id => $value])->commit();

					return true;
				}
			]
		];
	}

	public function selected(ModelWithContent $model): array
	{
		return $model->revision()->value($this->id) ?? [];
	}

}
