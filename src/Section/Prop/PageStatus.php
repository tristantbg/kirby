<?php

namespace Kirby\Section\Prop;

use Kirby\Foundation\Enumeration;

/**
 * Page Status
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class PageStatus extends Enumeration
{
	public array $allowed = [
		'draft',
		'unlisted',
		'listed',
	];

	public mixed $default = 'draft';
}
