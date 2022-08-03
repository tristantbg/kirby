<?php

namespace Kirby\Attribute;

use Kirby\Foundation\Factory;
use Kirby\Foundation\Renderable;

/**
 * Attribute
 *
 * @package   Kirby Attribute
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
abstract class Attribute implements Renderable
{
	abstract public static function factory($value = null): ?static;
}
