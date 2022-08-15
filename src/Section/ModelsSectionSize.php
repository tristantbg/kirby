<?php

namespace Kirby\Section;

use Kirby\Blueprint\Enumeration;

/**
 * Size option for items in models sections
 *
 * @package   Kirby Section
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class ModelsSectionSize extends Enumeration
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
		$field = parent::field();
		$field->id = 'size';
		$field->label->translations = ['en' => 'Size'];

		return $field;
	}

}
