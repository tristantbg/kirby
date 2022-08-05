<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

/**
 * Url node with query string superpowers
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NodeUrl extends NodeString
{
	public function __construct(
		public string $value
	) {
	}

	public function render(ModelWithContent $model): string
	{
		return $model->toSafeString($this->value);
	}
}
