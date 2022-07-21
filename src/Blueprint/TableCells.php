<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

class TableCells extends Collection
{
	public const TYPE = TableCell::class;

	public static function factory(array $items = []): static
	{
		$cells = new static;

		foreach ($items as $id => $value) {
			$cell = new TableCell(
				id: $id,
				value: $value
			);

			$cells->__set($cell->id, $cell);
		}

		return $cells;
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
