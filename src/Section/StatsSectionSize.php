<?php

namespace Kirby\Section;

use Kirby\Blueprint\Enumeration;

/**
 * Size option for text
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class StatsSectionSize extends Enumeration
{
	public static array $allowed = [
		'auto',
		'tiny',
		'small',
		'medium',
		'large',
		'huge'
	];

	public static mixed $default = 'auto';

	public static function field()
	{
		return parent::field()->set('id', 'size')->set('label', 'Size');
	}

}
