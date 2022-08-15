<?php

namespace Kirby\Field;

use Kirby\Architect\InspectorSection;
use Kirby\Cms\ModelWithContent;
use Kirby\Value\DateTimeValue;

/**
 * Date field
 *
 * @package   Kirby Field
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class DateField extends InputField
{
	public const TYPE = 'date';
	public DateTimeValue $value;

	public function __construct(
		public string $id,
		public bool $calendar = true,
		public string|null $default = null,
		public string|null $display = null,
		public string|null $format = 'Y-m-d H:i:s',
		public FieldIcon|null $icon = null,
		public string|null $max = null,
		public string|null $min = null,
		public DateFieldStep|null $step = null,
		public $time = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new DateTimeValue(
			max: $this->max,
			min: $this->min,
			required: $this->required,
		);
	}

	public function defaults(): void
	{
		$this->display ??= 'YYYY-MM-DD';
		$this->icon    ??= new FieldIcon('calendar');
		$this->step    ??= new DateFieldStep;

		parent::defaults();
	}

	public static function inspectorAppearanceSection(): InspectorSection
	{
		$section = parent::inspectorAppearanceSection();

		$section->fields->display = new TextField(id: 'display');
		$section->fields->icon    = FieldIcon::field();

		return $section;
	}

	public static function inspectorDescriptionSection(): InspectorSection
	{
		$section = parent::inspectorDescriptionSection();
		$section->fields->placeholder = FieldPlaceholder::field();

		return $section;
	}

	public static function inspectorValidationSection(): InspectorSection
	{
		$section = parent::inspectorValidationSection();

		$section->fields->min = new TextField(id: 'min');
		$section->fields->max = new TextField(id: 'max');

		return $section;
	}

	public static function inspectorValueSection(): InspectorSection
	{
		$section = parent::inspectorValueSection();

		$section->fields->default = new TextField(id: 'default');
		$section->fields->format  = new TextField(id: 'format');

		return $section;
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'display' => $this->display,
			'icon'    => $this->icon->render($model),
			'max'     => $this->max,
			'min'     => $this->min,
			'step'    => $this->step->render($model),
		];
	}
}
