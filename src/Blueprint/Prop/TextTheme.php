<?php

namespace Kirby\Blueprint\Prop;

use Kirby\Foundation\Enumeration;

/**
 * Theme option for text (buttons, etc.)
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TextTheme extends Enumeration
{
	public array $allowed = [
		'negative',
		'notice',
		'positive',
	];

	public mixed $default = 'positive';
}
