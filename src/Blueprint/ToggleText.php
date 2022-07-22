<?php

namespace Kirby\Blueprint;

use Kirby\Foundation\Component;

/**
 * Toggle text
 *
 * @package   Kirby Blueprint
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class ToggleText extends Component
{
	public function __construct(
		public Text $off,
		public Text $on,
	) {
	}

	public static function factory(string|array|null $props = null): static
	{
		// default text
		if ($props === null) {
			$on  = ['*' => 'on'];
			$off = ['*' => 'off'];

		// the same text for both states
		} else if (is_string($props) === true) {
			$on  = $props;
			$off = $props;

		// two values for both states
		} else {
			// don't care about keys
			$props = array_values($props);

			$off = $props[0] ?? null;
			$on  = $props[1] ?? $off;
		}

		return new static(
			on:  new Text($on),
			off: new Text($off)
		);
	}
}
