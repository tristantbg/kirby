<?php

namespace Kirby\Enumeration;

/**
 * Font option for the textarea for example
 *
 * @package   Kirby Enumeration
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Font extends Enumeration
{
	public array $allowed = [
		'sans',
		'monospace',
	];

	public mixed $default = 'sans';
}
