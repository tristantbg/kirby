<?php

namespace Kirby\Option;

use Kirby\Foundation\Factory;
use Kirby\Attribute\IconAttribute;
use Kirby\Attribute\TextAttribute;

/**
 * Option for select fields, radio fields, etc
 *
 * @package   Kirby Option
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Option
{
	public function __construct(
		public float|int|string|null $value,
		public bool $disabled = false,
		public IconAttribute|null $icon = null,
		public TextAttribute|null $info = null,
		public TextAttribute|null $text = null
	) {
		$this->text ??= new TextAttribute(['*' => $this->value]);
	}

	public static function factory(string|array $props): static
	{
		if (is_string($props) === true) {
			$props = ['value' => $props];
		}

		Factory::apply($props['icon'], IconAttribute::class);
		Factory::apply($props['info'], TextAttribute::class);
		Factory::apply($props['text'], TextAttribute::class);

		return new static(...$props);
	}

	public function id(): string|int|float
	{
		return $this->value;
	}
}
