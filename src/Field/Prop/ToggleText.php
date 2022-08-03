<?php

namespace Kirby\Field\Prop;

use Kirby\Attribute\TextAttribute;
use Kirby\Cms\ModelWithContent;
use Kirby\Foundation\Component;

/**
 * Toggle text
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class ToggleText extends Component
{
	public function __construct(
		public TextAttribute $off,
		public TextAttribute $on,
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
			on:  new TextAttribute($on),
			off: new TextAttribute($off)
		);
	}

	public function render(ModelWithContent $model): mixed
	{
		return [$this->off->value, $this->on->value];
	}
}
