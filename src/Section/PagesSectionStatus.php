<?php

namespace Kirby\Section;

use Kirby\Blueprint\Enumeration;

/**
 * Page status for pages section
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PagesSectionStatus extends Enumeration
{
	public static array $allowed = [
		'all',
		'draft',
		'listed',
		'published',
		'unlisted',
		'unpublished'
	];

	public static mixed $default = 'draft';

	public function hasAddButton(): bool
	{
		return in_array($this->value, ['draft', 'all']) === true;
	}

	public function isSortable(): bool
	{
		return in_array($this->value, ['listed', 'published', 'all']) === true;
	}
}
