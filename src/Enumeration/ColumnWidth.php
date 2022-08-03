<?php

namespace Kirby\Enumeration;

/**
 * The width of columns in blueprints
 *
 * @package   Kirby Enumeration
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class ColumnWidth extends Enumeration
{
	public array $allowed = [
		'1/1',
		'1/2',
		'1/3',
		'1/4',
		'2/3',
		'3/4',
	];

	public mixed $default = '1/1';
}
