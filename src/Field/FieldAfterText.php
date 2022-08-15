<?php

namespace Kirby\Field;

use Kirby\Blueprint\NodeText;

/**
 * Optional text that will be shown after the input in a field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FieldAfterText extends NodeText
{
	public static function field()
	{
		$field = parent::field();

		$field->id    = 'after';
		$field->label = new FieldLabel(['en' => 'After']);

		return $field;
	}
}
