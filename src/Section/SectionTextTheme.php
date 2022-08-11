<?php

namespace Kirby\Section;

use Kirby\Blueprint\Enumeration;

/**
 * Theme option for text (buttons, etc.)
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class SectionTextTheme extends Enumeration
{
	public static array $allowed = [
		null,
		'negative',
		'notice',
		'positive',
	];

	public static mixed $default = null;
}
