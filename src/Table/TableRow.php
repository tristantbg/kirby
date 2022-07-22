<?php

namespace Kirby\Table;

use Kirby\Cms\ModelWithContent;
use Kirby\Foundation\Component;

/**
 * Table row
 *
 * @package   Kirby Table
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
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
