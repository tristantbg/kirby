<?php

namespace Kirby\Foundation;

/**
 * Factory
 *
 * @package   Kirby Foundation
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
interface Factory
{
	public static function factory(array $props);
}
