<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

class TableRow extends Component
{
	public function __construct(
		public string $id,
		public TableCells $cells
	) {

	}

	public function render(ModelWithContent $model, TableColumns $columns = null): mixed
	{
		return $this->cells->render($model, $columns);
	}
}
