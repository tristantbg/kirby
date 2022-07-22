<?php

namespace Kirby\Field;

use Kirby\Blueprint\When;
use Kirby\Blueprint\Width;
use Kirby\Foundation\NodeWithType;

/**
 * Base field class
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Field extends NodeWithType
{
	public const TYPE = 'field';

	public function __construct(
		public string $id,
		public When|null $when = null,
		public Width|null $width = null,
	) {
	}

}
