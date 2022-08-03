<?php

namespace Kirby\Enumeration;

/**
 * Theme option for sections and fields
 *
 * @package   Kirby Enumeration
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Theme extends Enumeration
{
	public array $allowed = [
		'info',
		'negative',
		'none',
		'notice',
		'plain',
		'positive',
	];

	public mixed $default = 'plain';
}
