<?php

namespace Kirby\Field;

use Kirby\Architect\Inspector;
use Kirby\Architect\InspectorSection;
use Kirby\Cms\ModelWithContent;
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
		public FieldAfterText|null $after = null,
		public FieldAutocomplete|null $autocomplete = null,
		public FieldBeforeText|null $before = null,
		public TextFieldConverter|null $converter = null,
		public bool|null $counter = null,
		public string|null $default = null,
		public FieldIcon|null $icon = null,
		public int|null $maxlength = null,
		public int|null $minlength = null,
		public string|null $pattern = null,
		public FieldPlaceholder|null $placeholder = null,
		public bool|null $spellcheck = null,
		...$args
	) {
		parent::__construct($id, ...$args);

		$this->value = new StringValue(
			maxlength: $this->maxlength,
			minlength: $this->minlength,
			pattern: $this->pattern,
			required: $this->required,
		);
	}

	public function defaults(): void
	{
		$this->counter    ??= true;
		$this->spellcheck ??= true;

		parent::defaults();
	}

	public static function inspectorDescriptionSection(): InspectorSection
	{
		$section = parent::inspectorDescriptionSection();

		$section->fields->placeholder = FieldPlaceholder::field();
		$section->fields->icon        = FieldIcon::field();
		$section->fields->before      = FieldBeforeText::field();
		$section->fields->after       = FieldAfterText::field();

		return $section;
	}

	public static function inspectorValidationSection(): InspectorSection
	{
		$section = parent::inspectorValidationSection();

		$section->fields->minlength  = new NumberField(id: 'minlength');
		$section->fields->maxlength  = new NumberField(id: 'maxlength');
		$section->fields->counter    = new ToggleField(id: 'counter');
		$section->fields->spellcheck = new ToggleField(id: 'spellcheck');
		$section->fields->pattern    = new TextField(id: 'pattern');

		return $section;
	}

	public static function inspectorValueSection(): InspectorSection
	{
		$section = parent::inspectorValueSection();

		$section->fields->default      = new TextField(id: 'default');
		$section->fields->autocomplete = FieldAutocomplete::field();
		$section->fields->converter    = TextFieldConverter::field();

		return $section;
	}

	public function render(ModelWithContent $model): array
	{
		return parent::render($model) + [
			'after'        => $this->after?->render($model),
			'autocomplete' => $this->autocomplete?->render($model),
			'before'       => $this->before?->render($model),
			'counter'      => $this->counter,
			'icon'         => $this->icon?->render($model),
			'maxlength'    => $this->maxlength,
			'minlength'    => $this->minlength,
			'pattern'      => $this->pattern,
			'placeholder'  => $this->placeholder?->render($model),
			'spellcheck'   => $this->spellcheck,
		];
	}
}
