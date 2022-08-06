<?php

namespace Kirby\Block;

use Kirby\Blueprint\Node;
use Kirby\Cms\ModelWithContent;

/**
 * Layout Type
 *
 * @package   Kirby Block
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class LayoutType extends Node
{
	public function __construct(
		public string $id,
		public LayoutTypeColumns|null $columns,
		...$args
	) {
		parent::__construct($id, ...$args);
	}

	public function render(ModelWithContent $model): array
	{
		return [
			'columns' => $this->columns?->render($model),
			'id'      => $this->id
		];
	}
}
