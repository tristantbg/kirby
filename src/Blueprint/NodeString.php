<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

/**
 * Simple string blueprint node
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NodeString extends NodeProperty
{
	public function __construct(
		public string $value,
	) {
	}

	public static function factory($value = null): ?static
	{
		if ($value === null) {
			return $value;
		}

		return new static($value);
	}

	public function render(ModelWithContent $model): ?string
	{
		return $this->value;
	}
}
