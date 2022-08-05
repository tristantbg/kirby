<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

/**
 * Represents a specific kind of bluepritn node
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
abstract class NodeofKind
{
	abstract public static function factory($value = null): ?static;

	public function render(ModelWithContent $model)
	{
		return null;
	}
}
