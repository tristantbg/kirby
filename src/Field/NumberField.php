<?php

namespace Kirby\Field;

use Kirby\Architect\InspectorSection;
use Kirby\Cms\ModelWithContent;
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
		public FieldAfterText|null $after = null,
		public FieldAutocomplete|null $autocomplete = null,
		public FieldBeforeText|null $before = null,
		public int|float|null $default = null,
		public FieldIcon|null $icon = null,
		public int|float|null $max = null,
		public int|float|null $min = null,
		public FieldPlaceholder|null $placeholder = null,
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

	public static function inspectorAppearanceSection(): InspectorSection
	{
		$section = parent::inspectorAppearanceSection();

		$section->fields->icon = FieldIcon::field();

		return $section;
	}

	public static function inspectorDescriptionSection(): InspectorSection
	{
		return TextField::inspectorDescriptionSection();
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

		$section->fields->default      = new NumberField(id: 'default');
		$section->fields->step         = new NumberField(id: 'step');
		$section->fields->autocomplete = FieldAutocomplete::field();

		return $section;
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'after'        => $this->after?->render($model),
			'autocomplete' => $this->autocomplete?->render($model),
			'before'       => $this->before?->render($model),
			'icon'         => $this->icon?->render($model),
			'max'          => $this->max,
			'min'          => $this->min,
			'placeholder'  => $this->placeholder?->render($model),
			'step'         => $this->step,
		];
	}
}
