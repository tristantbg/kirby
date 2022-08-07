<?php

namespace Kirby\Value;

use Closure;
use Kirby\Blueprint\Collection;
use Kirby\Toolkit\A;

/**
 * Values
 *
 * @package   Kirby Value
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Values extends Collection
{
	public const TYPE = Value::class;

	public function toArray(Closure $map = null): array
	{
		return A::map($this->data, $map ?? fn ($value) => $value->data);
	}

	public function toStrings(): array
	{
		return A::map(
			$this->data,
			fn ($value) => $value->isEmpty() ? null : $value->__toString()
		);
	}
}
