<?php

namespace Kirby\Blueprint;

use Kirby\Toolkit\Str;

/**
 * Label blueprint node
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NodeLabel extends NodeText
{
	public static function fallback(string $id): static
	{
		return new static(['en' => Str::ucfirst($id)]);
	}
}
