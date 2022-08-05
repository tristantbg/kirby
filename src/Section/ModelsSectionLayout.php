<?php

namespace Kirby\Section;

use Kirby\Blueprint\Enumeration;

/**
 * Layout option for items in pages and files sections
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class ModelsSectionLayout extends Enumeration
{
	public array $allowed = [
		'cards',
		'cardlets',
		'list',
		'table'
	];

	public mixed $default = 'list';
}
