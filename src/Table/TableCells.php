<?php

namespace Kirby\Table;

use Kirby\Blueprint\Collection;
use Kirby\Cms\ModelWithContent;

/**
 * Table cells
 *
 * @package   Kirby Table
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TableCells extends Collection
{
	public const TYPE = TableCell::class;

	public static function factory(array $cells)
	{
		$collection = new static;

		foreach ($cells as $id => $value) {
			$cell = new TableCell(
				id: $id,
				value: $value
			);

			$collection->__set($cell->id, $cell);
		}

		return $collection;
	}

	public function render(ModelWithContent $model, TableColumns $columns = null): mixed
	{
		if ($columns === null) {
			return parent::render($model);
		}

		$props = [];

		// get or create a cell for each column
		foreach ($columns as $id => $column) {
			$cell = $this->data[$id] ?? new TableCell($id);
			$props[$id] = $cell->render($model, $column);
		}

		return $props;
	}

}
