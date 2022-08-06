<?php

namespace Kirby\Option;

use Closure;
use Kirby\Toolkit\Collection as BaseCollection;

/**
 * NestCollection
 *
 * @package   Kirby Option
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NestCollection extends BaseCollection
{
	/**
	 * Converts all objects in the collection
	 * to an array. This can also take a callback
	 * function to further modify the array result.
	 */
	public function toArray(Closure|null $map = null): array
	{
		return parent::toArray($map ?? fn ($object) => $object->toArray());
	}
}
