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
		// seems like a class name
		if (str_contains($id, '\\') === true) {
			$path = explode('\\', $id);
			$id   = array_pop($path);
		}

		return new static(['en' => Str::ucfirst($id)]);
	}

	public static function field()
	{
		$field = parent::field();
		$field->id = 'label';
		$field->label->translations = ['en' => 'Label'];

		return $field;
	}
}
