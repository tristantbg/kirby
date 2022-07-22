<?php

namespace Kirby\Field;

use Kirby\Blueprint\Options;
use Kirby\Value\OptionsValue;

/**
 * Foundation for checkboxes and multiselect
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class OptionsField extends InputField
{
	public const TYPE = 'options';
	public OptionsValue $value;

	public function __construct(
		public string $id,
		public string|int|float|null $default = null,
		public int|null $max = null,
		public int|null $min = null,
		public string $separator = ',',
		public Options|null $options = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new OptionsValue(
			// resolve options lazily to avoid processing
			// them on construction
			allowed: fn () => $this->options()->keys(),
			max: $this->max,
			min: $this->min,
			required: $this->required,
			separator: $this->separator,
		);
	}

	public function options(): Options
	{
		return $this->options ?? new Options;
	}

}
