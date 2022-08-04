<?php

namespace Kirby\Field\Prop;

/**
 * Uploads options
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Uploads
{
	public function __construct(
		public string|null $parent = null,
		public string|null $template = null
	) {
	}

	public static function factory(string|array $props): static
	{
		if (is_string($props) === true) {
			$props = ['parent' => $props];
		}

		return new static(...$props);
	}
}
