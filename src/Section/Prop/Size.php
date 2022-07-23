<?php

namespace Kirby\Section\Prop;

use Kirby\Foundation\Enumeration;

/**
 * Size option for sections and fields
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Size extends Enumeration
{
	public array $allowed = [
		'auto',
		'tiny',
		'small',
		'medium',
		'large',
		'huge'
	];

	public string|null $default = 'auto';
}
