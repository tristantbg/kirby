<?php

namespace Kirby\Field;

use Kirby\Blueprint\After;
use Kirby\Blueprint\Before;
use Kirby\Blueprint\Icon;
use Kirby\Blueprint\ToggleText;
use Kirby\Value\BoolValue;

/**
 * Toggle field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class ToggleField extends InputField
{
	public const TYPE = 'toggle';
	public BoolValue $value;

	public function __construct(
		public string $id,
		public After|null $after = null,
		public bool $autofocus = false,
		public Before|null $before = null,
		public bool|null $default = null,
		public Icon|null $icon = null,
		public ToggleText|null $text = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->text ??= ToggleText::factory();

		$this->value = new BoolValue;
	}
}
