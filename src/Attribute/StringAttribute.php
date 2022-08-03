<?php

namespace Kirby\Attribute;

use Kirby\Cms\ModelWithContent;

/**
 * Simple string attribute
 *
 * @package   Kirby Attribute
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class StringAttribute extends Attribute
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
