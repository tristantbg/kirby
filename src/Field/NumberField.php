<?php

namespace Kirby\Field;

use Kirby\Blueprint\After;
use Kirby\Blueprint\Before;
use Kirby\Blueprint\Icon;
use Kirby\Blueprint\Placeholder;
use Kirby\Value\NumberValue;

/**
 * Number field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class NumberField extends InputField
{
	public const TYPE = 'number';
	public NumberValue $value;

	public function __construct(
		public string $id,
		public After|null $after = null,
		public string|null $autocomplete = null,
		public Before|null $before = null,
		public int|float|null $default = null,
		public Icon|null $icon = null,
		public int|float|null $max = null,
		public int|float|null $min = null,
		public Placeholder|null $placeholder = null,
		public int|float|null $step = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new NumberValue(
			max:      $this->max,
			min: 	  $this->min,
			required: $this->required
		);
	}
}
