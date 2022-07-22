<?php

namespace Kirby\Field;

use Kirby\Blueprint\After;
use Kirby\Blueprint\Before;
use Kirby\Blueprint\Converter;
use Kirby\Blueprint\Icon;
use Kirby\Blueprint\Placeholder;
use Kirby\Value\StringValue;

/**
 * Text field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class TextField extends InputField
{
	public const TYPE = 'text';
	public StringValue $value;

	public function __construct(
		string $id,
		public After|null $after = null,
		public string|null $autocomplete = null,
		public Before|null $before = null,
		public Converter|null $converter = null,
		public bool $counter = true,
		public string|null $default = null,
		public Icon|null $icon = null,
		public int|null $maxlength = null,
		public int|null $minlength = null,
		public string|null $pattern = null,
		public Placeholder|null $placeholder = null,
		public bool $spellcheck = false,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new StringValue(
			maxlength: $this->maxlength,
			minlength: $this->minlength,
			pattern:   $this->pattern
		);
	}
}
