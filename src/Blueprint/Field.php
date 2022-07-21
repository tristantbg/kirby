<?php

namespace Kirby\Blueprint;

use Kirby\Cms\ModelWithContent;

/**
 * Base field class
 *
 * @package   Kirby Blueprint
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
