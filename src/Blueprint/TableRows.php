<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;
use Kirby\Data\Yaml;

class TableRows extends Collection
{
	public const TYPE = TableRow::class;

	public static function factory(string|array $items = []): static
	{
		if (is_string($items) === true) {
			$items = Yaml::decode($items);
		}

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
