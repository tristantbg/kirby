<?php

namespace Kirby\Table;

use Kirby\Cms\ModelWithContent;

/**
 * Table cell
 *
 * @package   Kirby Table
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TableCell
{
	public function __construct(
		public string $id,
		public mixed $value = null
	) {
	}

	public static function factory(array $props): static
	{
		return new static(...$props);
	}

	public function render(ModelWithContent $model, TableColumn $column = null): mixed
	{
		if ($column === null) {
			return $this->value;
		}

		return $column->value($model, $this->value);
	}
}
