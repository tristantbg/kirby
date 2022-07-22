<?php

namespace Kirby\Blueprint;

use Kirby\Foundation\Enumeration;

/**
 * Font option for the textarea for example
 *
 * @package   Kirby Blueprint
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

	public string|null $default = 'sans';
}
