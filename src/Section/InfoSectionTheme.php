<?php

namespace Kirby\Section;

use Kirby\Blueprint\Enumeration;

/**
 * Theme option for the info section
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class InfoSectionTheme extends Enumeration
{
	public static array $allowed = [
		'info',
		'negative',
		'none',
		'notice',
		'plain',
		'positive',
	];

	public static mixed $default = 'plain';
}
