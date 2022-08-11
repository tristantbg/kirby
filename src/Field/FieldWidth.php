<?php

namespace Kirby\Field;

use Kirby\Blueprint\NodeWidth;

/**
 * The width of the field in the field grid.
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FieldWidth extends NodeWidth
{
	public static array $allowed = [
		'1/1',
		'1/2',
		'1/3',
		'1/6',
		'1/4',
		'2/3',
		'2/6',
		'3/4',
		'3/6',
		'4/6',
		'5/6',
	];

	public static mixed $default = '1/1';
}
