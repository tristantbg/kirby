<?php

namespace Kirby\Table;

use Kirby\Cms\ModelWithContent;
use Kirby\Foundation\Factory;

/**
 * Table
 *
 * @package   Kirby Table
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Table
{
	public function __construct(
		public TableColumns $columns,
		public TableRows $rows,
	) {
	}

	public static function factory(array $props): static
	{
		$props = Factory::apply($props, [
			'columns' => TableColumns::class,
			'rows'    => TableRows::class
		]);

		return new static(...$props);
	}

	public function render(ModelWithContent $model): array
	{
		return [
			'columns' => $this->columns->render($model),
			'rows'    => $this->rows->render($model, $this->columns)
		];
	}
}
