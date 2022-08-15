<?php

namespace Kirby\Field;

use Kirby\Architect\InspectorSection;
use Kirby\Cms\ModelWithContent;
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
		return $this->options ?? new FieldOptions();
	}

	public static function polyfill(array $props): array
	{
		return parent::polyfill(FieldOptions::polyfill($props));
	}

	public static function inspectorValidationSection(): InspectorSection
	{
		$section = parent::inspectorValidationSection();

		$section->fields->min = new NumberField(id: 'min');
		$section->fields->max = new NumberField(id: 'max');

		return $section;
	}

	public static function inspectorValueSection(): InspectorSection
	{
		$section = parent::inspectorValueSection();

		$section->fields->default   = new TextField(id: 'default');
		$section->fields->separator = new TextField(id: 'separator');

		return $section;
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
