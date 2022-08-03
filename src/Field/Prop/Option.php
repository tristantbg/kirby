<?php

namespace Kirby\Field\Prop;

use Kirby\Attribute\IconAttribute;
use Kirby\Attribute\TextAttribute;
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
		public float|int|string|null $value,
		public bool $disabled = false,
		public IconAttribute|null $icon = null,
		public TextAttribute|null $info = null,
		public TextAttribute|null $text = null
	) {
		$this->text ??= new TextAttribute(['*' => $this->value]);
	}

	public function id(): string|int|float
	{
		return $this->value;
	}
}
