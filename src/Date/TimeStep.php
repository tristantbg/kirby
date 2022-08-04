<?php

namespace Kirby\Date;

/**
 * Time step
 *
 * @package   Kirby Date
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TimeStep extends DateStep
{
	public function __construct(
		public int $size = 5,
		public string $unit = 'minute',
	) {
	}
}
