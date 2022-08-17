<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;
use Kirby\Cms\Pages;

/**
 * Pages Picker Dialog
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PagesPickerDialog extends PickerDialog
{
	public const ITEMS = PagesItems::class;

	public function __construct(
		public string $id,
		public bool $subpages = true,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function component(): string
	{
		return 'k-pages-picker-dialog';
	}

	public function models(ModelWithContent $model, array $query = []): Pages
	{
		$models = match (true) {
			// with query
			$this->query !== null => $model->query($this->query),

			// models without children
			is_a($model, File::class),
			is_a($model, User::class) => $model->site()->children(),

			// models with children
			default => $model->children()
		};

		$models = $this->applySearch($models, $query);
		$models = $this->applyPagination($models, $query);

		return $models;
	}

	public function options(): array
	{
		return parent::options() + [
			'subpages' => $this->subpages
		];
	}
}
