<?php

namespace Kirby\Field;

use Kirby\Blueprint\Enumeration;

/**
 * Font option for the textarea for example
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TextareaFieldFont extends Enumeration
{
	public static array $allowed = [
		'sans',
		'monospace',
	];

	public static mixed $default = 'sans';

	public static function field()
	{
		$field = parent::field();
		$field->id = 'font';
		$field->label->translations = ['en' => 'Font Family'];

		return $field;
	}
}
