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

	public static function inspector(): Inspector
	{
		$inspector = parent::inspector();

		// description
		$description                      = $inspector->sections->description;
		$description->fields->placeholder = FieldPlaceholder::field();
		$description->fields->icon        = FieldIcon::field();
		$description->fields->before      = FieldBeforeText::field();
		$description->fields->after       = FieldAfterText::field();

		// validation
		$validation                    = $inspector->sections->validation;
		$validation->fields->minlength = new NumberField(id: 'minlength');
		$validation->fields->maxlength = new NumberField(id: 'maxlength');
		$validation->fields->counter   = new ToggleField(id: 'counter');
		$validation->fields->pattern   = new TextField(id: 'pattern');

		// value
		$inspector->sections->add(
			new InspectorSection(
				id: 'value',
				fields: new Fields([
					new TextField(id: 'default'),
					new ToggleField(id: 'spellcheck'),
					FieldAutocomplete::field(),
					TextFieldConverter::field(),
				])
			)
		);

		return $inspector;
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
