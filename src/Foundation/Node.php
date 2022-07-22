<?php

namespace Kirby\Foundation;

/**
 * Node
 *
 * @package   Kirby Foundation
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Node extends Component
{
	public function __construct(
		public string $id
	) {
	}
}
