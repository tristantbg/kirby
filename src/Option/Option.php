<?php

namespace Kirby\Option;

use Kirby\Blueprint\Factory;
use Kirby\Blueprint\NodeText;
use Kirby\Blueprint\NodeIcon;

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
		public NodeIcon|null $icon = null,
		public NodeText|null $info = null,
		public NodeText|null $text = null
	) {
		$this->text ??= new NodeText(['*' => $this->value]);
	}

	public static function factory(string|array $props): static
	{
		if (is_string($props) === true) {
			$props = ['value' => $props];
		}

		$props = Factory::apply($props, [
			'icon' => NodeIcon::class,
			'info' => NodeText::class,
			'text' => NodeText::class
		]);

		return new static(...$props);
	}

	public function id(): string|int|float
	{
		return $this->value;
	}
}
