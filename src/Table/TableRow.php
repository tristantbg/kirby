<?php

namespace Kirby\Table;

use Kirby\Cms\ModelWithContent;
use Kirby\Foundation\Factory;

/**
 * Table row
 *
 * @package   Kirby Table
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TableRow
{
	public function __construct(
		public string $id,
		public TableCells $cells
	) {
	}

	public static function factory(array $props): static
	{
		Factory::apply($props['cells'], TableCells::class);

		return new static(...$props);
	}

	public function render(ModelWithContent $model, TableColumns $columns = null): mixed
	{
		return $this->cells->render($model, $columns);
	}
}
