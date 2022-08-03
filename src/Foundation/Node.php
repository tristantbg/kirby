<?php

namespace Kirby\Foundation;

use Kirby\Blueprint\Config;
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

	public static function load(string|array $props): static
	{
		// load by path
		if (is_string($props) === true) {
			$props = static::loadProps($props);
		}

		return static::factory($props);
	}

	public static function loadProps(string $path): array
	{
		$config = new Config($path);
		$props  = $config->read();

		// add the id if it's not set yet
		$props['id'] ??= basename($path);

		return $props;
	}

}
