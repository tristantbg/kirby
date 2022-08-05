<?php

namespace Kirby\Field;

/**
 * Time step
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TimeFieldStep extends DateFieldStep
{
	public function __construct(
		public int $size = 5,
		public string $unit = 'minute',
	) {
	}
}
