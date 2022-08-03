<?php

namespace Kirby\Attribute;

use Kirby\Cms\ModelWithContent;

/**
 * Attribute
 *
 * @package   Kirby Attribute
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
abstract class Attribute
{
	abstract public static function factory($value = null): ?static;

	public function render(ModelWithContent $model)
	{
		return null;
	}
}
