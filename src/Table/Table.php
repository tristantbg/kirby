<?php

namespace Kirby\Table;

use Kirby\Cms\ModelWithContent;
use Kirby\Foundation\Component;

/**
 * Table
 *
 * @package   Kirby Table
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Table extends Component
{
	public function __construct(
		public TableColumns $columns,
		public TableRows $rows,
	) {
	}

	public function render(ModelWithContent $model): mixed
	{
		return $this->rows->render($model, $this->columns);
	}
}
