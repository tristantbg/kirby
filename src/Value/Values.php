<?php

namespace Kirby\Value;

use Closure;
use Kirby\Foundation\Collection;

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
		return array_map($map ?? function ($value) {
			return $value->data;
		}, $this->data);
	}

	public function toStrings(): array
	{
		return array_map(function ($value) {
			if ($value->isEmpty() === true) {
				return null;
			}

			return $value->__toString();
		}, $this->data);
	}
}
