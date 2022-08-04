<?php

namespace Kirby\Writer;

use Kirby\Foundation\Bools;

/**
 * Nodes
 *
 * @package   Kirby Writer
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
