<?php

namespace Kirby\Blueprint;

use Kirby\Field\FieldLabel;

/**
 * The width of nodes in blueprints
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NodeWidth extends Enumeration
{
	public static array $allowed = [
		'1/1',
		'1/2',
		'1/3',
		'1/4',
		'2/3',
		'3/4',
	];

	public static mixed $default = '1/1';

	public static function field()
	{
		$field = parent::field();
		$field->label->translations = ['*' => 'Width'];

		return $field;
	}

}
