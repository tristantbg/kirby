<?php

namespace Kirby\Blueprint;

use Kirby\Foundation\Enumeration;

/**
 * Text Alignment
 *
 * @package   Kirby Blueprint
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

	public string|null $default = 'left';
}
