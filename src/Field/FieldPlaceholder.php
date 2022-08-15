<?php

namespace Kirby\Field;

use Kirby\Blueprint\NodeText;

/**
 * Optional placeholder value that will be shown when the field is empty
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FieldPlaceholder extends NodeText
{
	public static function field()
	{
		$field = parent::field();

		$field->id    = 'placeholder';
		$field->label = new FieldLabel(['en' => 'Placeholder']);

		return $field;
	}
}
