<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;
use Kirby\Toolkit\A;

class TableCell extends Component
{
	public function __construct(
		public string $id,
		public mixed $value = null
	) {
	}

	public static function factory(array $props = []): static
	{
		return new static(
			id:    $props['id']    ?? null,
			value: $props['value'] ?? null
		);
	}

	public function render(ModelWithContent $model, TableColumn $column = null): mixed
	{
		if ($column === null) {
			return $this->value;
		}

		return $column->value($model, $this->value);
	}
}
