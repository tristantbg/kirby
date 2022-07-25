<?php

namespace Kirby\Blueprint\Prop;

use Kirby\Foundation\Enumeration;

/**
 * Theme option for sections and fields
 *
 * @package   Kirby Blueprint
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
