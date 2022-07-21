<?php

namespace Kirby\Blueprint;

/**
 * Factory
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
interface Factory
{
	public static function factory(array $props);
}
