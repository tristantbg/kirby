<?php

namespace Kirby\Enumeration;

/**
 * Size option for items in sections
 *
 * @package   Kirby Enumeration
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class ItemSize extends Enumeration
{
	public array $allowed = [
		'auto',
		'tiny',
		'small',
		'medium',
		'large',
		'huge'
	];

	public mixed $default = 'auto';
}
