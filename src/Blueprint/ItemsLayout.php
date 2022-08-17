<?php

namespace Kirby\Blueprint;

use Kirby\Blueprint\Enumeration;

/**
 * Layout option for items in pages and files sections
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class ItemsLayout extends Enumeration
{
	public static array $allowed = [
		'cards',
		'cardlets',
		'list',
		'table'
	];

	public static mixed $default = 'list';

	public static function field()
	{
		$field = parent::field();
		$field->id = 'layout';
		$field->label->translations = ['en' => 'Layout'];

		return $field;
	}
}
