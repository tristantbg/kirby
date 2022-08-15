<?php

namespace Kirby\Field;

use Kirby\Blueprint\NodeText;

/**
 * Optional text that will be shown before the input in a field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FieldBeforeText extends NodeText
{
	public static function field()
	{
		$field = parent::field();

		$field->id    = 'before';
		$field->label = new FieldLabel(['en' => 'Before']);

		return $field;
	}
}
