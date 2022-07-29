<?php

namespace Kirby\Foundation;

use Kirby\Blueprint\Extension;

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
		public string $id,
		public Extension|null $extends = null,
	) {
		$this->defaults();
	}

	public function defaults(): void
	{
	}

	public static function factory(array $props): static
	{
		return parent::factory(Extension::apply($props));
	}
}
