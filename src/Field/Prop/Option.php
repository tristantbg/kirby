<?php

namespace Kirby\Field\Prop;

use Kirby\Blueprint\Prop\Icon;
use Kirby\Blueprint\Prop\Text;
use Kirby\Foundation\Component;

/**
 * Option for select fields, radio fields, etc
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Option extends Component
{
	public function __construct(
		public string|int|float $value,
		public bool $disabled = false,
		public Icon|null $icon = null,
		public Text|null $info = null,
		public Text|null $text = null
	) {
		$this->text ??= new Text($value);
	}

	public function id(): string|int|float
	{
		return $this->value;
	}

	public static function factory(array $props): static
	{
		return new static(
			// disabled options
			disabled: $props['disabled'] ?? false,

			// icons are optional and not available for all fields
			icon: isset($props['icon']) ? new Icon($props['icon']) : null,

			// info text
			info: isset($props['info']) ? new Text($props['info']) : null,

			// passing null will create an empty option
			value: $props['value'] ?? '',

			// only add the text if it's passed in the array
			text: isset($props['text']) ? new Text($props['text']) : null
		);
	}
}
