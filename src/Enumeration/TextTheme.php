<?php

namespace Kirby\Enumeration;

/**
 * Theme option for text (buttons, etc.)
 *
 * @package   Kirby Enumeration
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TextTheme extends Enumeration
{
	public array $allowed = [
		null,
		'negative',
		'notice',
		'positive',
	];

	public mixed $default = null;
}
