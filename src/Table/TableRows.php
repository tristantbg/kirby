<?php

namespace Kirby\Table;

use Kirby\Cms\ModelWithContent;
use Kirby\Foundation\Collection;

/**
 * Table rows
 *
 * @package   Kirby Table
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TableRows extends Collection
{
	public const TYPE = TableRow::class;

	public static function factory(array $items = []): static
	{
		$rows = new static;

		foreach ($items as $id => $cells) {
			$row = new TableRow(
				id: $id,
				cells: TableCells::factory($cells)
			);

			$rows->__set($row->id, $row);
		}

		return $rows;
	}

	public function render(ModelWithContent $model, TableColumns $columns = null): mixed
	{
		return array_map(fn ($item) => $item->render($model, $columns), $this->data);
	}
}
