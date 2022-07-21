<?php

namespace Kirby\Value;

/**
 * Time Value
 *
 * @package   Kirby Value
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TimeValue extends DateTimeValue
{
	public function __toString(): string
	{
		return $this->data?->format('H:i:s');
	}
}
