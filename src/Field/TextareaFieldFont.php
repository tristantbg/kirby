<?php

namespace Kirby\Field;

use Kirby\Blueprint\Enumeration;

/**
 * Font option for the textarea for example
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TextareaFieldFont extends Enumeration
{
	public array $allowed = [
		'sans',
		'monospace',
	];

	public mixed $default = 'sans';
}
