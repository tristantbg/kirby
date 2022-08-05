<?php

namespace Kirby\Layout;

use Kirby\Blueprint\Enumeration;

/**
 * The width of columns in the layout field
 *
 * @package   Kirby Layout
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class LayoutWidth extends Enumeration
{
	public array $allowed = [
		'1/1', '1/2', '1/3', '1/4', '1/6', '1/12',
		'2/2', '2/3', '2/4', '2/6', '2/12',
		'3/3', '3/4', '3/6', '3/12',
		'4/4', '4/6', '4/12',
		'5/6', '5/12',
		'6/6', '6/12',
		'7/12',
		'8/12',
		'9/12',
		'10/12',
		'11/12',
		'12/12'
	];

	public mixed $default = '1/1';
}
