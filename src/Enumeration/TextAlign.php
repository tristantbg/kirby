<?php

namespace Kirby\Enumeration;

/**
 * Text Alignment
 *
 * @package   Kirby Enumeration
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TextAlign extends Enumeration
{
	public array $allowed = [
		'left',
		'center',
		'right'
	];

	public mixed $default = 'left';
}
