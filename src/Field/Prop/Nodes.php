<?php

namespace Kirby\Field\Prop;

use Kirby\Blueprint\Prop\Bools;

/**
 * Nodes
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Nodes extends Bools
{
	public function __construct(
		public bool $bulletList = true,
		public bool $heading = true,
		public bool $paragraph = true,
		public bool $orderedList = true,
	) {
	}
}
