<?php

namespace Kirby\Blueprint;

/**
 * Font size options
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FontSize extends Enumeration
{
	public array $allowed = [
		'small',
		'medium',
		'large',
		'huge',
	];

	public string|null $default = 'medium';
}
