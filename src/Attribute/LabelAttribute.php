<?php

namespace Kirby\Attribute;

use Kirby\Toolkit\Str;

/**
 * Label Attribute
 *
 * @package   Kirby Attribute
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class LabelAttribute extends TextAttribute
{
	public static function fallback(string $id): static
	{
		return new static(['en' => Str::ucfirst($id)]);
	}
}
