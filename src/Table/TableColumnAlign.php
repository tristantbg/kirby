<?php

namespace Kirby\Table;

use Kirby\Blueprint\Enumeration;

/**
 * Text Alignment
 *
 * @package   Kirby Table
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TableColumnAlign extends Enumeration
{
	public static array $allowed = [
		'left',
		'center',
		'right'
	];

	public static mixed $default = 'left';
}
