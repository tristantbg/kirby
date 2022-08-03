<?php

namespace Kirby\Enumeration;

/**
 * The field value will be converted with the selected converter before the value gets saved. Available converters: `lower`, `upper`, `ucfirst`, `slug`
 *
 * @package   Kirby Enumeration
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Converter extends Enumeration
{
	public array $allowed = [
		null,
		'lower',
		'slug',
		'ucfirst',
		'upper',
	];
}
