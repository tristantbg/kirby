<?php

namespace Kirby\Field;

use Kirby\Cms\ModelWithContent;
use Kirby\Option\Options;
use Kirby\Option\OptionsApi;
use Kirby\Option\OptionsQuery;
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
		public FieldOptions|null $options = null,
		public string $separator = ',',
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new OptionsValue(
			// resolve options lazily to avoid processing
			// them on construction
			allowed: fn ($model) => $this->options->resolve($model)->keys(),
			max: $this->max,
			min: $this->min,
			required: $this->required,
			separator: $this->separator,
		);
	}

	public function options(): FieldOptions
	{
		return $this->options ?? FieldOptions::factory();
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'max'     => $this->max,
			'min'     => $this->min,
			'options' => $this->options?->render($model)
		];
	}
}
