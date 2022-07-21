<?php

namespace Kirby\Blueprint;

/**
 * Layout option
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Layout extends Enumeration
{
	public array $allowed = [
		'cards',
		'cardlets',
		'list',
		'table'
	];

	public string|null $default = 'list';
}
