<?php

namespace Kirby\Field;

use Kirby\Blueprint\Enumeration;

/**
 * Size option for text
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TextareaFieldSize extends Enumeration
{
	public static array $allowed = [
		'auto',
		'tiny',
		'small',
		'medium',
		'large',
		'huge'
	];

	public static mixed $default = 'auto';

	public static function field()
	{
		$field = parent::field();
		$field->id = 'size';
		$field->label->translations = ['en' => 'Font Size'];

		return $field;
	}
}
