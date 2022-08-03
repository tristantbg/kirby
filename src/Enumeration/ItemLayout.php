<?php

namespace Kirby\Enumeration;

/**
 * Layout option for items in pages and files sections
 *
 * @package   Kirby Enumeration
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class ItemLayout extends Enumeration
{
	public array $allowed = [
		'cards',
		'cardlets',
		'list',
		'table'
	];

	public mixed $default = 'list';
}
